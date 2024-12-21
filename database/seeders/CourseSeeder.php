<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = [
            [
                'course_title' => 'Basic Web Development',
                'course_slug' => Str::slug('Basic Web Development'),
                'duration' => '3 months',
                'summary' => 'Learn the foundations of HTML, CSS, and JavaScript.',
                'course_price' => 99.99,
                'course_feature_image' => 'web-development.jpg',
                'status' => 1,
            ],
            [
                'course_title' => 'Mastering Python',
                'course_slug' => Str::slug('Mastering Python'),
                'duration' => '6 months',
                'summary' => 'Become proficient in Python programming for data analysis and web development.',
                'course_price' => 149.99,
                'course_feature_image' => 'python-course.jpg',
                'status' => 1,
            ],
        ];

        foreach ($courses as $course) {
            DB::table('courses')->insert([
                'course_title' => $course['course_title'],
                'course_slug' => $course['course_slug'],
                'duration' => $course['duration'],
                'summary' => $course['summary'],
                'course_price' => $course['course_price'],
                'course_feature_image' => $course['course_feature_image'],
                'status' => $course['status'],
                'last_update' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
