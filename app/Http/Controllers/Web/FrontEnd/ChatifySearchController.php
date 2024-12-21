<?php

namespace App\Http\Controllers\Web\FrontEnd;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\User;
use Chatify\Facades\ChatifyMessenger as Chatify;
use Illuminate\Support\Facades\Auth;

use Chatify\ChatifyMessenger;

class ChatifySearchController extends ChatifyMessenger
{
    /**
     * Search in messenger
     *
     * @param Request $request
     * @return JsonResponse|void
     */
    public function search(Request $request)
    {
        $getRecords = null;
        $input = trim(filter_var($request['input']));
        $records = User::where('id', '!=', Auth::user()->id)
            ->where('name', 'LIKE', "%{$input}%")
            ->paginate($request->per_page ?? $this->perPage);

        foreach ($records->items() as $record) {
            $getRecords .= view('Chatify::layouts.listItem', [
                'get' => 'search_item',
                'user' => Chatify::getUserWithAvatar($record),
            ])->render();
        }

        if ($records->total() < 1) {
            $getRecords = '<p class="message-hint center-el"><span>Nothing to show.</span></p>';
        }

        // send the response
        return Response::json([
            'records' => $getRecords,
            'total' => $records->total(),
            'last_page' => $records->lastPage()
        ], 200);
    }
}
