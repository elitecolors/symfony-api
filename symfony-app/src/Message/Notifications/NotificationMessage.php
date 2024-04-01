<?php

declare(strict_types=1);

namespace App\Message\Notifications;


use App\Message\Notifications\Notification\NotificationInterface;

readonly class NotificationMessage implements NotificationInterface
{
    public function __construct(private int $receiverId, private NotificationInterface $notification)
    {
    }

    public function getReceiverId(): int
    {
        return $this->receiverId;
    }

    public function getNotification(): NotificationInterface
    {
        return $this->notification;
    }

    public function getMessage(): string|null
    {
        // TODO: Implement getMessage() method.
        return '';
    }
}
