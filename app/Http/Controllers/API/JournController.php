<?php

namespace App\Http\Controllers\Api;

use App\Models\Journal;
use App\Traits\apiresponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class JournController extends Controller
{
    use apiresponse;
    /**
    * Display a listing of the resource.
    * @return \Illuminate\Http\JsonResponse
    */
   public function index($id)
   {
       $myJournals = Journal::where('user_id', $id)->latest()->get();
       return $this->success($myJournals, 'My Jorunal retrieved successfully', 200);
   }

   /**
    * Store a newly created resource in storage.
    * @param Request $request
    * @return \Illuminate\Http\RedirectResponse
    */
   public function store(Request $request, $id)
   {
       $validation = Validator::make($request->all(), [
           'today_deed' => 'required|string|max:50',
           'improve' => 'required|string|max:200',
           'today_learn' => 'required|string|max:50',
           'today_unlearn' => 'required|string|max:50',
           'grateful' => 'required|string|max:50',
           'hadith' => 'required|string|max:50',
       ]);

       if($validation->fails()){
           return $this->error($validation->errors(), 'Validation error', 401);
       }

       try {
           $data = new Journal();
           $data->user_id = $id;
           $data->today_deed = $request->today_deed;
           $data->improve = $request->improve;
           $data->today_learn = $request->today_learn;
           $data->today_unlearn = $request->today_unlearn;
           $data->grateful = $request->grateful;
           $data->hadith = $request->hadith;
           $data->save();

           return $this->success($data, 'Journal created successfully');
       } catch (\Exception $exception) {
           return $this->success($data, $exception->getMessage());
       }
   }
}
