<?php

declare(strict_types=1);

namespace App\EventListener;

use App\Entity\Product;
use App\Message\Notifications\Notification\ProductNotification;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\PostPersistEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsEntityListener(event: Events::postPersist, method: 'onPostPersist', entity: Product::class)]
class ProductUpdate
{
    public function __construct(
        private readonly MessageBusInterface $bus
    ) {}
    public function onPostPersist(Product $product, PostPersistEventArgs $event): void
    {
        $productMessage = new ProductNotification($product);

        $this->bus->dispatch($productMessage);

    }

}
