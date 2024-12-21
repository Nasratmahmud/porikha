<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\NewsLetter;
use App\Traits\apiresponse;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsLetterController extends Controller
{
    use apiresponse;
    /**
     * Get All News Letter
     * This method returns all news letters which have active status
     * @return JsonResource
     */
    public function index()
    {
        // retrieve all news letter with active status
        $news = NewsLetter::where('status', 'active')->latest()->get(['id', 'pdf', 'created_at']);

        // return the news letter with success message
        return $this->success([
            'newsLetter' => $news,
        ], "News Letter fetched successfully", 200);
    }
}
