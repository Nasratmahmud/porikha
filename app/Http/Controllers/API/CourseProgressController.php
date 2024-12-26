<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CourseContent;
use App\Models\UserCourseProgress;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CourseProgressController extends Controller
{
    /**
     * Update course progress for a user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCourseProgress(Request $request)
    {
        // Step 1: Validate the incoming request
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'course_content_id' => 'required|exists:course_contents,id',
            'is_completed' => 'required|boolean', // Flag to indicate if video is completed
        ]);

        // Step 2: Retrieve the video duration from the database
        $content = CourseContent::findOrFail($validated['course_content_id']);

        // Step 3: Convert the video duration (HH:MM:SS) to total seconds
        $totalDurationInSeconds = $this->convertToSeconds($content->content_length);

        // Step 4: If the video is completed, mark as completed
        if ($validated['is_completed']) {
            UserCourseProgress::updateOrCreate(
                [
                    'user_id' => $request->user()->id,
                    'course_id' => $validated['course_id'],
                    'course_content_id' => $validated['course_content_id'],
                ],
                [
                    'is_completed' => true, // Mark as completed
                ],
            );

            return response()->json(['message' => 'Video marked as completed!']);
        }

        return response()->json(['message' => 'Video is still in progress.']);
    }

    public function getProgressRate($courseId, Request $request)
    {
        $userId = $request->user()->id;

        // Step 1: Fetch all course content for the course
        $courseContents = CourseContent::where('course_id', $courseId)->get();

        // Step 2: Calculate the total duration of the course
        $totalDuration = $courseContents->reduce(function ($carry, $content) {
            return $carry + $this->convertToSeconds($content->content_length);
        }, 0);

        // Step 3: Fetch user's completed progress for this course
        $completedProgress = UserCourseProgress::where('user_id', $userId)->where('course_id', $courseId)->where('is_completed', true)->get();

        // Step 4: Calculate the watched duration
        $watchedDuration = $completedProgress->reduce(function ($carry, $progress) {
            return $carry + $this->convertToSeconds($progress->content->content_length);
        }, 0);

        // Step 5: Calculate progress percentage
        $progressRate = $totalDuration > 0 ? round(($watchedDuration / $totalDuration) * 100, 2) : 0;

        return response()->json([
            'progress_rate' => $progressRate,
            'watched_duration' => $watchedDuration,
            'total_duration' => $totalDuration,
        ]);
    }

    /**
     * Convert HH:MM:SS to total seconds.
     *
     * @param string $time
     * @return int
     */
    private function convertToSeconds($time)
    {
        // Use Carbon to convert the time (HH:MM:SS) to seconds
        // $duration = Carbon::createFromFormat('H:i:s', $time);
        // return $duration->hour * 3600 + $duration->minute * 60 + $duration->second;

        if (is_null($time) || trim($time) === '') {
            return 0; // Default to 0 if time is null or empty
        }

        try {
            // Parse the time with Carbon, assuming the format is HH:MM:SS
            $duration = Carbon::createFromFormat('H:i:s', $time);
            return $duration->hour * 3600 + $duration->minute * 60 + $duration->second;
        } catch (\Exception $e) {
            return 0; // Return 0 if the time format is invalid
        }
    }
}
