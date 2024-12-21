<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\DuaBookmark;
use App\Models\HaditBookmark;
use App\Traits\apiresponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Validator;

class BookmarkController extends Controller
{
    use apiresponse;

/* 
     #Surah Bookmark
     =======================================================
*/

    /**
     * Get All Surah Bookmarks
     * @return \Illuminate\Http\Response
     */
    public function surahBookmarkIndex()
    {
        $bookMarks = Bookmark::where('user_id', auth()->user()->id)->get();
        return $this->success([
            'bookmarks' => $bookMarks,
        ], "Bookmarks fetched successfully", 200);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function surahBookmarkStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'surah_id' => 'required|integer',
            'ayat_id' => 'required|integer',
            'number_in_suraah' => 'required|integer',
            'arabic_text' => 'required|string',
            'translate_en' => 'required|string',
            'audio' => 'required|string|url',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Validation error', 401);
        }

        $exist = Bookmark::where('user_id', auth()->user()->id)->where('ayat_id', $request->ayat_id)->first();
        if ($exist) {
            return $this->error($exist, 'Bookmark already exist', 401);
        }

        $booMark = new Bookmark();
        $booMark->user_id = auth()->user()->id;
        $booMark->surah_id = $request->surah_id;
        $booMark->ayat_id = $request->ayat_id;
        $booMark->number_in_suraah = $request->number_in_suraah;
        $booMark->arabic_text = $request->arabic_text;
        $booMark->translate_en = $request->translate_en;
        $booMark->audio = $request->audio;
        $booMark->save();
        return $this->success([
            'bookmark' => $booMark,
        ], "Bookmark created successfully", 200);

    }

    /**
     * Delete Surah bookmark
     * @param  $id
     * @return JsonResponse
     */
    public function surahBookmarkDestroy($id){
        $exist = Bookmark::where('user_id', auth()->user()->id)->where('id', $id)->first();
        if ($exist) {
            $exist->delete();
            return $this->success([], 'Bookmark Deleted Successfull', 202);
        }else{
            return $this->error([],"Bookmark Not Found");
        }
    }
/* 
     #Surah Bookmark
     =======================================================
*/

    /**
     * Get All Hadit Bookmark
     * @return \Illuminate\Http\Response
     */
    public function haditBookmarkIndex()
    {
        $bookMarks = HaditBookmark::where('user_id', auth()->user()->id)->get();
        return $this->success([
            'bookmarks' => $bookMarks,
        ], "Bookmarks fetched successfully", 200);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function haditBookmarkStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hadith_number' => 'required|integer',
            'body' => 'required|string',
            'bookName' => 'required|string',
            'book_number' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Validation error', 401);
        }

        $exist = HaditBookmark::where('user_id', auth()->user()->id)->where('body', $request->body)->first();
        if ($exist) {
            return $this->error($exist, 'Hadith Bookmark already exist', 401);
        }

        $booMark = new HaditBookmark();
        $booMark->user_id = auth()->user()->id;
        $booMark->hadith_number = $request->hadith_number;
        $booMark->body = $request->body;
        $booMark->bookName = $request->bookName;
        $booMark->book_number = $request->book_number;
        $booMark->save();
        return $this->success([
            'bookmark' => $booMark,
        ], "Hadith Bookmark created successfully", 200);

    }

    /**
     * Delete Surah bookmark
     * @param  $id
     * @return JsonResponse
     */
    public function haditBookmarkDestroy($id){
        $exist = HaditBookmark::where('user_id', auth()->user()->id)->where('id', $id)->first();
        if ($exist) {
            $exist->delete();
            return $this->success([], 'Hadith Bookmark Deleted Successfull', 202);
        }else{
            return $this->error([],"Hadith Bookmark Not Found");
        }
    }

    
/* 
     #Surah Bookmark
     =======================================================
*/

    /**
     * Get All Dua Bookmark
     * @return \Illuminate\Http\Response
     */
    public function duahBookmarkIndex()
    {
        $bookMarks = DuaBookmark::where('user_id', auth()->user()->id)->get();
        return $this->success([
            'bookmarks' => $bookMarks,
        ], "Bookmarks fetched successfully", 200);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function duahBookmarkStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dua_id' => 'required|exists:duas,id',
            'arabic' => 'required|string',
            'translate_en' => 'required|string',
            'meaning' => 'required|string',
            'refference' => 'required|string',
            'book_name' => 'required|string',
            'vol' => 'required|integer',
            'book_no' => 'required|integer',
            'hadit_no' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Validation error', 401);
        }

        $exist = DuaBookmark::where('user_id', auth()->user()->id)->where('arabic', $request->arabic)->first();
        if ($exist) {
            return $this->error($exist, 'Duah Bookmark already exist', 401);
        }

        $bookMark = new DuaBookmark();
        $bookMark->user_id = auth()->user()->id;
        $bookMark->dua_id = $request->dua_id;
        $bookMark->arabic = $request->arabic;
        $bookMark->translate_en = $request->translate_en;
        $bookMark->meaning = $request->meaning;
        $bookMark->refference = $request->refference;
        $bookMark->book_name = $request->book_name;
        $bookMark->vol = $request->vol;
        $bookMark->book_no = $request->book_no;
        $bookMark->hadit_no = $request->hadit_no;
        $bookMark->save();
        return $this->success([
            'bookmark' => $bookMark,
        ], "Duah Bookmark created successfully", 200);

    }

    /**
     * Delete Surah bookmark
     * @param  $id
     * @return JsonResponse
     */
    public function duahBookmarkDestroy($id){
        $exist = DuaBookmark::where('user_id', auth()->user()->id)->where('id', $id)->first();
        if ($exist) {
            $exist->delete();
            return $this->success([], 'Dua Bookmark Deleted Successfull', 202);
        }else{
            return $this->error([],"Dua Bookmark Not Found");
        }
    }
}
