<?php


namespace App\Product\Domain\ValueObject;

use App\Shared\Domain\ProductDetails;

class ComicBookDetails implements ProductDetails
{
    public function getDetails() : array
    {
        // TODO: Implement getMetadata() method.
    }

    function toString(): string
    {
        // TODO: Implement toString() method.
    }

    function fromArray(array $details): ProductDetails
    {
        // TODO: Implement fromArray() method.
    }
}
