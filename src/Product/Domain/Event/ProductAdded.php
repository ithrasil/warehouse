<?php


namespace App\Product\Domain\Event;


use App\Product\Domain\Product;
use App\Product\Domain\ValueObject\ProductId;
use App\Shared\Domain\ProductDetails;
use Prooph\EventSourcing\AggregateChanged;

class ProductAdded extends AggregateChanged
{
    private ProductId $productId;

    private string $name;

    private string $type;

    private int $quantity;

    private ProductDetails $details;

    private \DateTime $date;

    public static function add(Product $product, \DateTime $date) {
        $event = self::occur(
            $product->getProductId(),
            [
                'date' => $date->format(\DateTime::ISO8601),
            ]
        );
        $event->name = $product->getName();
        $event->type = $product->getType();
        $event->name = $product->getName();
        $event->quantity = $product->getQuantity();
        $event->details = call_user_func($product->getType() .'::fromString', $product->getDetails());

        return $event;
    }

    public function productId() : ProductId
    {
        if ($this->productId === null) {
            $this->productId = ProductId::fromString($this->aggregateId());
        }

        return $this->productId;
    }

    public function name() : string
    {
        return $this->name;
    }

    public function type() : string
    {
        return $this->type;
    }

    public function quantity() : int
    {
        return $this->quantity;
    }

    public function details() : ProductDetails
    {
        return $this->details;
    }

    /**
     * @throws \Exception
     */
    public function date() : \DateTime
    {
        if ($this->date === null) {
            $this->date = new \DateTime($this->payload['date']);
        }

        return $this->date;
    }
}
