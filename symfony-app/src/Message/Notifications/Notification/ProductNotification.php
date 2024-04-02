<?php

declare(strict_types=1);

namespace App\Message\Notifications\Notification;

use App\Entity\Product;

final readonly class ProductNotification
{

   public function __construct(private Product $product
   ) {
   }

    public function getCode (): string
    {
        return $this->product->getCode();
    }
}
