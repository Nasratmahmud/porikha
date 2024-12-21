<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller {
    public function markAsRead( Request $request, $notificationId ) {
        if ( $request->ajax() ) {
            $notification = $request->user()->notifications()->where( 'id', $notificationId )->first();
            if ( $notification && !$notification->read_at ) {
                $notification->markAsRead();
                return response()->json( [
                    'notification_count' => $request->user()->unreadNotifications->count(),
                    'success'            => true,
                    'message'            => 'Mark As Read this Notification',
                ] );
            }
        }
    }
}
