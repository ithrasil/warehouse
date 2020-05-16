<?php


namespace App\Product\Domain\ValueObject;

use App\Shared\Domain\ProductDetails;

class BeerDetails implements ProductDetails
{
    private string $style;

    private string $alcoholContent;

    private int $quantity;

    private string $capacity;

    public function __construct(string $style, string $alcoholContent, int $quantity, string $capacity)
    {
        $this->style = $style;
        $this->alcoholContent = $alcoholContent;
        $this->quantity = $quantity;
        $this->capacity = $capacity;
    }

    public function getDetails(): array
    {
        return [
            'style' => $this->style,
            'alcoholContent' => $this->alcoholContent,
            'quantity' => $this->quantity,
            'capacity' => $this->capacity,
        ];
    }

    function toString(): string
    {
        return json_encode($this->getDetails());
    }

    function fromArray(array $details) : self {
        return new self(
            $details['style'],
            $details['alcoholContent'],
            (int) $details['quantity'],
            $details['capacity'],
        );
    }
}
