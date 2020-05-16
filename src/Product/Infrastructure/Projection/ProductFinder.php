<?php


namespace App\Product\Infrastructure\Projection;


use App\Product\Domain\Product;
use App\Shared\Infrastructure\Projection\AggregateRootsTable;
use Doctrine\DBAL\Driver\Connection;

class ProductFinder
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function findAll(int $page = 1, int $perPage = 1)
    {
        $query = sprintf('SELECT * FROM %s', AggregateRootsTable::PRODUCT);
        $products = $this->connection->fetchAll($query);
        $result = [];
        foreach ($products as $product) {
            $result[] = Product::fromArray($product);
        }

        return $result;
    }
}
