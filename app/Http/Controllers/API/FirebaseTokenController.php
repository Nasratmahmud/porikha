<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FirebaseTokens;
use Illuminate\Support\Facades\Validator;
class FirebaseTokenController extends Controller
{
     /**
     * News Serve For Frontend
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'nullable|exists:users,id',
            'token'=>'required|string',
            'device_id'=>'required|string',
            'is_active'=>'nullable|boolean',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }
        $user = FirebaseTokens::where('user_id', $request->user_id)->where('device_id', $request->device_id);
        if($user){
            $user->delete();
        }
        try {
            $data = new FirebaseTokens();
            $data->user_id = $request->user_id;
            $data->token = $request->token;
            $data->device_id = $request->device_id;
            $data->is_active = $request->is_active;
            $data->save();

            return response()->json([
                'status' => true,
                'message' => 'Token saved successfully',
                'data' => $data,
                'code' => 200,
            ], 200 );
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'No records found',
                'code' => 418 ,
                'data'=> [],
            ], 418 );
        }
    }

    /**
     * Get Single Record
     * @param $token, $device_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'device_id' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }
        $user_id = $request->user_id;
        $device_id = $request->device_id;
        $data = FirebaseTokens::where('user_id', $user_id)->where('device_id', $device_id)->first();
        if(!$data){
            return response()->json([
                'status' => false,
                'message' => 'No records found',
                'code' => 404 ,
                'data'=> [],
            ], 404 );
        }
        return response()->json([
            'status' => true,
            'message' => 'Token fetched successfully',
            'data' => $data,
            'code' => 200,
        ], 200 );
    }

    /**
     * Delete Token Single Record
     * @param $token, $device_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'device_id' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }

        $user = FirebaseTokens::where('user_id', $request->user_id)->where('device_id', $request->device_id);
        if($user){
            $user->delete();
            return response()->json([
                'status' => true,
                'message' => 'Token deleted successfully',
                'code' => 200,
            ], 200 );
        }else{
            return response()->json([
                'status' => false,
                'message' => 'No records found',
                'code' => 404 ,
            ], 404 );
        }
    }
}
