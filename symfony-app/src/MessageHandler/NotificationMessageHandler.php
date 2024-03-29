<?php

declare(strict_types=1);

namespace App\MessageHandler;

use App\Message\Notifications\NotificationMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class NotificationMessageHandler
{
    public function __construct() {}
    public function __invoke(NotificationMessage $message): void
    {
        dd($message);


    }

}
