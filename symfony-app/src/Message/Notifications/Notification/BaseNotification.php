<?php

declare(strict_types=1);

namespace App\Message\Notifications\Notification;

abstract class BaseNotification implements NotificationInterface
{
    public function __construct() {}

    public function getMessage(): string|null
    {
        // TODO: Implement getMessage() method.

        return 'test';
    }
}
