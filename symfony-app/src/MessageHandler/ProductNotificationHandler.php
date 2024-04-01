<?php

declare(strict_types=1);

namespace App\MessageHandler;

use App\Message\Notifications\Notification\ProductNotification;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class ProductNotificationHandler
{
    public function __invoke(ProductNotification $notification): void
    {
    }
}
