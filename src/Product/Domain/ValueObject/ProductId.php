<?php


namespace App\Product\Domain\ValueObject;


use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class ProductId
{
    private UuidInterface $uuid;

    public static function generate(): ProductId
    {
        return new self(Uuid::uuid4());
    }

    public static function fromString(string $id): ProductId
    {
        return new self(Uuid::fromString($id));
    }

    public function __construct(UuidInterface $id)
    {
        $this->uuid = $id;
    }

    public function toString(): string
    {
        return $this->uuid->toString();
    }
}
