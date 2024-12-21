<?php

namespace App\Http\Controllers\API;

use App\Models\Messaging;
use App\Traits\apiresponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MessagingController extends Controller
{
    use apiresponse;
    /**
     * Get All Dua Categories
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Messaging::where('user_id', auth()->user()->id)->first();
        if(!$messages) {
            return $this->success([], "User Messages Not Found", 200);
        }
        $myMessgae = Messaging::where('room_id', $messages->room_id)->get();
        return $this->success([
            'messages' => $myMessgae,
        ], "User Messages fetched successfully", 200);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'message' => 'required|string',
        ]);

        if ($validation->fails()) {
            return $this->error($validation->errors(), 'Validation error', 401);
        }

        $roomFetch = Messaging::where('user_id', auth()->user()->id)->first();
        if($roomFetch) {
            $room = $roomFetch->room_id;
        } else {
            $room = rand(1111, 9999);
        }

        $message = new Messaging();
        $message->room_id = $room;
        $message->user_id = auth()->user()->id;
        $message->message = $request->message;
        $message->save();

        // Handel Notification

        return $this->success([
            'message' => $message,
        ], "Message Send successfully", 200);
    }
}
