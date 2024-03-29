<?php

declare(strict_types=1);

namespace App\Message\Notifications\Notification;

final class ProductNotification extends BaseNotification implements NotificationInterface
{

   public function __construct(
   ) {
       parent::__construct();
   }

    public function getCode (): string
    {
        return '$this->product->getCode();';
    }

}
