<?php

namespace App\Http\Controllers\API;

use App\Models\Comment;
use App\Models\Replies;
use App\Traits\apiresponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RepliesController extends Controller
{
    use apiresponse;

    /**
     * Display a spcific post's comment.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View | \Illuminate\Http\JsonResponse
     */
    public function getCommentReplies($comment_id)
    {
        $comment = Comment::findOrFail($comment_id);
        if ($comment) {
            $replies = Replies::where('comment_id', $comment_id)->get();
            return $this->success($replies, 'Retrieved Data Successfully', 200);
        } else {
            return $this->error([], "Comment Not found", 404);
        } 
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View | \Illuminate\Http\RedirectResponse
     */
    public function updateOrCreate(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'post_id' => 'required|numeric|exists:communities,id',
            'comment_id' => 'required|numeric|exists:comments,id',
            'replay' => 'required|string|max:255',
            'id' => 'nullable|numeric|exists:replies,id',
        ]);

        if ($validation->fails()) {
            return $this->error($validation->errors(), 'Validation error', 401);
        }

        try {
            $data = Replies::updateOrCreate(
                [
                    'id' => $request->id,
                ],
                [
                    'community_id' => $request->post_id,
                    'comment_id' => $request->comment_id,
                    'replay' => $request->replay,
                    'user_id' => auth()->user()->id,
                ]
            );

            return $this->success($data, 'Replay created successfully');
        } catch (\Exception $exception) {
            return $this->success([], $exception->getMessage());
        }
    }


    /**
     * Delete selected item
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $data = Replies::where('id', $id)->first();
        if (!$data) {
            return $this->error([], "Reply Not Found", 404);
        }
        $data->delete();
        return response()->json([
            'success' => true,
            'message' => 'Replay deleted successfully.',
        ]);
    }
}
