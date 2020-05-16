<?php


namespace App\Product\Infrastructure\Projection;


use App\Shared\Infrastructure\Projection\AggregateRootsTable;
use Doctrine\DBAL\Driver\Connection;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Prooph\EventStore\Projection\AbstractReadModel;

class ProductReadModel extends AbstractReadModel
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function init(): void
    {
        $schema = new Schema();
        $product = $schema->createTable(AggregateRootsTable::PRODUCT);
        $product->addColumn('product_id', Types::STRING);
        $product->addColumn('name', Types::STRING);
        $product->addColumn('type', Types::STRING);
        $product->addColumn('quantity', Types::INTEGER, ['default' => 0]);
        $product->addColumn('details', Types::JSON);
        $product->addColumn('reserved', Types::BOOLEAN, ['default' => false]);
        $product->addColumn('reserved_until', Types::DATETIME_IMMUTABLE, ['default' => null]);
        $product->addColumn('created_at', Types::DATETIME_IMMUTABLE, ['default' => null]);
        $product->addColumn('updated_at', Types::DATETIME_IMMUTABLE, ['default' => null]);
        $product->setPrimaryKey(['product_id']);

        $platform = $this->connection->getDatabasePlatform();
        foreach ($schema->toSql($platform) as $query) {
            $this->connection->exec($query);
        }
    }

    public function isInitialized(): bool
    {
        return $this->connection->getSchemaManager()->tablesExist([AggregateRootsTable::PRODUCT]);
    }

    public function reset(): void
    {
        $this->connection->delete(AggregateRootsTable::PRODUCT, []);
    }

    public function delete(): void
    {
        $this->connection->getSchemaManager()->dropTable(AggregateRootsTable::PRODUCT);
    }

    public function insert(array $data) : void
    {
        $this->connection->insert(AggregateRootsTable::PRODUCT, $data);
    }
}
