<?php


namespace App\Shared\Domain;


use App\Product\Domain\Product;

interface ProductList
{
    public function save(Product $product) : void;

    public function get(Product $product);
}
