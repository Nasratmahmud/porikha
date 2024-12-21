<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Community;
use App\Models\Like;
use App\Traits\apiresponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommunityController extends Controller
{
    use apiresponse;
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View | \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $posts = Community::with('comments', 'user')->get();

        $posts->each(function ($post) {
            $post->liked = Like::where('community_id', $post->id)->where('user_id', auth()->user()->id)->exists();
        });

        return $this->success($posts, 'Post retrieved successfully', 200);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View | \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'content' => 'required|string|unique:communities,content,' . $request->content,
        ]);

        if ($validation->fails()) {
            return $this->error($validation->errors(), 'Validation error', 401);
        }

        try {
            $data = new Community();
            $data->content = $request->content;
            $data->user_id = auth()->user()->id;
            $data->save();

            return $this->success($data, 'Post created successfully');
        } catch (\Exception $exception) {
            return $this->success($data, $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View | \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'content' => 'required|string|unique:communities,content,' . $request->id,
            'id' => 'required|exists:communities,id',
        ]);

        if ($validation->fails()) {
            return $this->error($validation->errors(), 'Validation error', 401);
        }

        try {
            $data = Community::findOrFail($request->id);
            if (!$data) {
                return $this->error($data, 'Post not found', 401);
            }
            $data->content = $request->content;
            $data->user_id = auth()->user()->id;

            $data->save();

            return $this->success($data, 'Post Updated successfully');
        } catch (\Exception $exception) {
            return $this->success($data, $exception->getMessage());
        }
    }

    /**
     * Delete selected item
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $data = Community::where('id', $id)->first();
        if (!$data) {
            return $this->error([], "Post Not Found", 404);
        }
        $data->delete();
        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully.',
        ]);
    }

    /**
     * Like Community
     * @param Request $request
     * @return JsonResponse
     */
    public function LikePost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'community_id' => 'required|exists:communities,id',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Validation error', 401);
        }

        try {

            $data = Like::where('community_id', $request->community_id)->where('user_id', auth()->user()->id)->first();
            if ($data) {
                $data->delete();
                return $this->success($data, 'Unliked successfully', 200);
            }else{
                $data = new Like();
                $data->community_id = $request->community_id;
                $data->user_id = auth()->user()->id;
                $data->save();
                return $this->success($data, 'Liked successfully', 200);
            }
        } catch (\Exception $exception) {
            return $this->error($data, $exception->getMessage());
        }
    }

}
