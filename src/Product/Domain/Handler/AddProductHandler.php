<?php


namespace App\Product\Domain\Handler;


use App\Product\Domain\Command\AddProduct;
use App\Product\Domain\Product;
use App\Shared\Domain\ProductList;

class AddProductHandler
{
    private ProductList $productList;

    public function __construct(ProductList $productList)
    {
        $this->productList = $productList;
    }

    public function __invoke(AddProduct $command)
    {
        $product = Product::add(
            $command->productId(),
            $command->name(),
            $command->type(),
            $command->quantity(),
            $command->details(),
            $command->date(),
        );

        $this->productList->save($product);
    }
}
