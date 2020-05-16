<?php


namespace App\Product\Domain;


use App\Product\Domain\Event\ProductAdded;
use App\Product\Domain\ValueObject\ProductId;
use App\Shared\Domain\ApplyEventHandlerMethod;
use App\Shared\Domain\ProductDetails;
use Prooph\EventSourcing\AggregateRoot;

class Product extends AggregateRoot
{
    use ApplyEventHandlerMethod;

    private ProductId $productId;

    private string $name;

    private string $type;

    private \DateTimeImmutable $created_at;

    private \DateTimeImmutable $updated_at;

    private ProductDetails $details;

    private bool $reserved;

    private \DateTimeImmutable $reservedUntil;

    private int $quantity;

    public function reserve(string $id): void
    {
        // TODO: Implement reservation
    }

    public function remove(string $id): void
    {
        // TODO: Implement removation
    }

    protected function aggregateId(): string
    {
        return $this->productId->toString();
    }

    public function toString(): string {
        return json_encode([
            'product_id' => $this->productId->toString(),
            'name' => $this->name,
            'type' => $this->type,
            'details' => $this->details->toString(),
            'reserved' => $this->reserved,
            'reservedUntil' => $this->reservedUntil,
            'quantity' => $this->quantity,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
    }

    public static function fromArray(array $product) : self
    {
        $product = new self();
        $product->productId = ProductId::fromString($product['product_id']);
        $product->name = $product['name'];
        $product->type = $product['type'];
        $product->created_at = $product['created_at'];
        $product->updated_at = $product['updated_at'];
        $product->details = $product['details'];
        $product->reserved = $product['reserved'];
        $product->reservedUntil = $product['reservedUntil'];
        $product->quantity = $product['quantity'];
        return $product;
    }

    public static function add(
        string $productId,
        string $name,
        string $type,
        int $quantity,
        ProductDetails $details,
        \DateTime $date = null
    ) : self {
        $self = new self();
        $self->setProductId($productId);
        $self->setName($name);
        $self->setType($type);
        $self->setQuantity($quantity);
        $self->setDetails($details);

        $self->recordThat(ProductAdded::add($self, $date));

        return $self;
    }

    public function getProductId(): ProductId
    {
        return $this->productId;
    }

    public function setProductId(ProductId $productId): void
    {
        $this->productId = $productId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    public function getDetails(): ProductDetails
    {
        return $this->details;
    }

    public function setDetails(ProductDetails $details): void
    {
        $this->details = $details;
    }

    public function reserved(): bool
    {
        return $this->reserved;
    }

    public function setReserved(bool $reserved): void
    {
        $this->reserved = $reserved;
    }

    public function getReservedUntil(): \DateTimeImmutable
    {
        return $this->reservedUntil;
    }

    public function setReservedUntil(\DateTimeImmutable $reservedUntil): void
    {
        $this->reservedUntil = $reservedUntil;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }
}
