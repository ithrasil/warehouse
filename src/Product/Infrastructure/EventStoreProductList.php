<?php


namespace App\Product\Infrastructure;


use App\Product\Domain\Product;
use App\Shared\Domain\ProductList;
use Prooph\EventSourcing\Aggregate\AggregateRepository;

class EventStoreProductList extends AggregateRepository implements ProductList
{
    public function save(Product $product) : void
    {
        $this->saveAggregateRoot($product);
    }

    public function get(Product $product)
    {
        return $this->getAggregateRoot($product->toString());
    }
}

