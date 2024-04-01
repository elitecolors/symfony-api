<?php

declare(strict_types=1);

namespace App\Message\Notifications\Notification;

use App\Entity\Product;

final class ProductNotification extends BaseNotification
{

   public function __construct(private readonly Product $product
   ) {
       parent::__construct();
   }

    public function getCode (): string
    {
        return $this->product->getCode();
    }
}
