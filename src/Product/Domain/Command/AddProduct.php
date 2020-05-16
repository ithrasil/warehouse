<?php


namespace App\Product\Domain\Command;


use App\Product\Domain\ValueObject\ProductId;
use App\Shared\Domain\ProductDetails;
use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadConstructable;
use Prooph\Common\Messaging\PayloadTrait;

class AddProduct extends Command implements PayloadConstructable
{
    use PayloadTrait;

    public static function add(
        string $productId,
        string $name,
        string $type,
        int $quantity,
        ProductDetails $details,
        \DateTime $date = null
    ) {
        return new self([
            'product_id' => $productId,
            'name' => $name,
            'type' => $type,
            'quantity' => $quantity,
            'details' => $details,
            'date' => $date ?: new \DateTime(),
        ]);
    }

    public function productId(): ProductId
    {
        return ProductId::fromString($this->payload['product_id']);
    }

    public function name() : string
    {
        return $this->payload['name'];
    }

    public function type() : string
    {
        return $this->payload['type'];
    }

    public function quantity() : int
    {
        return $this->payload['quantity'];
    }

    public function details(): ProductDetails
    {
        return call_user_func($this->payload['type'].'::fromString', $this->payload['details']);
    }

    public function date() : ?\DateTime
    {
        return isset($this->payload['date']) ? $this->payload['date'] : null;
    }
}

