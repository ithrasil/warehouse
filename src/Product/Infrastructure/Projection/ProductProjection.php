<?php


namespace App\Product\Infrastructure\Projection;


use App\Product\Domain\Event\ProductAdded;
use Prooph\EventStore\Projection\ReadModelProjector;
use Prooph\Bundle\EventStore\Projection\ReadModelProjection;

class ProductProjection implements ReadModelProjection
{
    public function project(ReadModelProjector $projector): ReadModelProjector
    {
        $projector->fromStream('event_stream')
            ->when([
                ProductAdded::class => function ($state, ProductAdded $event) {
                    /**
                     * @var ReadModelProjector $this
                     */
                    $readModel = $this->readModel();

                    $readModel->stack('insert', [
                        'product_id' => $event->productId(),
                        'name' => $event->name(),
                        'type' => $event->type(),
                        'quantity' => $event->quantity(),
                        'details' => $event->details()->toString(),
                        'created_at' => $event->date() ? $event->date()->format(\DateTime::ISO8601) : null,
                        'updated_at' => $event->date() ? $event->date()->format(\DateTime::ISO8601) : null,
                    ]);

                    return $state;
                }
            ]);
        return $projector;
    }
}



