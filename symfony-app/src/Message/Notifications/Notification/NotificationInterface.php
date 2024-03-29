<?php

namespace App\Message\Notifications\Notification;

interface NotificationInterface
{
    public function getMessage(): string|null;

}
