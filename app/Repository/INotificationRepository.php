<?php

namespace App\Repositories;

use App\Models\Notification;


interface INotificationRepository
{
    public function create(array $notification);
    public function delete($id);
}