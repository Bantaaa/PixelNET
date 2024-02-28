<?php

namespace App\Services;

use App\Models\Notification;

class NotificationService{
    public function addNotification($request){
        $user_id = $request->user()->id;

        Notification::create([
            'user_id' => $user_id,
            'is_read' => null,
            'message' => $request->message,
        ]);

        return redirect()->route('home');
    }
}