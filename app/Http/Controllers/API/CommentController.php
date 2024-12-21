<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Community;
use App\Traits\apiresponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    use apiresponse;
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View | \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $mycomments = Comment::where('user_id', auth()->user()->id)->with('replies','user')->get();
        return $this->success($mycomments, 'My comment retrieved successfully', 200);
    }

    /**
     * Display a spcific post's comment.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View | \Illuminate\Http\JsonResponse
     */
    public function getPostComment($post_id)
    {
        $post = Community::findOrFail($post_id);
        if ($post) {
            $comments = Comment::where('community_id', $post_id)->with('replies','user')->get();
            return $this->success($comments, 'My comment retrieved successfully', 200);
        } else {
            return $this->error([], "Post Not found", 404);
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
            'comment' => 'required|string|max:255',
            'id' => 'nullable|numeric|exists:comments,id',
        ]);

        if ($validation->fails()) {
            return $this->error($validation->errors(), 'Validation error', 401);
        }

        try {
            $data = Comment::updateOrCreate(
                [
                    'id' => $request->id,
                ],
                [
                    'community_id' => $request->post_id,
                    'comment' => $request->comment,
                    'user_id' => auth()->user()->id,
                ]
            );

            return $this->success($data, 'Comment created successfully');
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
        $data = Comment::where('id', $id)->first();
        if (!$data) {
            return $this->error([], "Comment Not Found", 404);
        }
        $data->delete();
        return response()->json([
            'success' => true,
            'message' => 'Comment deleted successfully.',
        ]);
    }
}
