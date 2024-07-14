<?php

namespace App\Infra\Product;

use App\Application\Product\ProductDTO;
use App\Application\Product\ProductRepositoryInterface;
use App\Core\Product;
use App\Infra\ProductType\ProductTypeRepository;
use PDO;

class ProductRepository implements ProductRepositoryInterface
{
  private PDO $conn;

  public function __construct(PDO $conn)
  {
    $this->conn = $conn;
  }

  public function store(ProductDTO $dto): bool
  {
    $sql = "INSERT INTO product (
                   name, description, price_in_cents, unit, brand, observation, product_type_id) 
            VALUES (:name, :description, :price_in_cents, :unit, :brand, :observation, :product_type_id
              )";
    $stmt = $this->conn->prepare($sql);

    return $stmt->execute([
      ':name' => $dto->name,
      ':description' => $dto->description,
      ':price_in_cents' => $dto->priceInCents,
      ':unit' => $dto->unit,
      ':brand' => $dto->brand,
      ':observation' => $dto->observation,
      ':product_type_id' => $dto->productType->getId()
    ]);
  }

  public function update(ProductDTO $dto): bool
  {
    $sql = "UPDATE product 
          SET name = :name, 
              description = :description, 
              price_in_cents = :price_in_cents, 
              unit = :unit, 
              brand = :brand, 
              observation = :observation, 
              product_type_id = :product_type_id 
          WHERE id = :id";
    $stmt = $this->conn->prepare($sql);

    return $stmt->execute([
      ':name' => $dto->name,
      ':description' => $dto->description,
      ':price_in_cents' => $dto->priceInCents,
      ':unit' => $dto->unit,
      ':brand' => $dto->brand,
      ':observation' => $dto->observation,
      ':product_type_id' => $dto->productTypeId,
      ':id' => $dto->productType->getId()
    ]);
  }

  public function delete(Product $product): bool
  {
    $sql = "DELETE FROM product WHERE id = :id";
    $stmt = $this->conn->prepare($sql);

    return $stmt->execute([
      ':id' => $product->getId()
    ]);
  }

  public function findById(int $id): ?Product
  {
    $sql = "SELECT * FROM product WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([':id' => $id]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
      return null;
    }

    return new Product(
      name: $result['name'],
      description: $result['description'],
      priceInCents: $result['price_in_cents'],
      unit: $result['unit'],
      brand: $result['brand'],
      observation: $result['observation'],
      productType: (new ProductTypeRepository($this->conn))->findById($result['product_type_id']),
      id: $result['id']
    );
  }

  public function findAll(): array
  {
    $sql = "SELECT * FROM product";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $products = [];
    foreach ($results as $result) {
      $product = new Product(
        name: $result['name'],
        description: $result['description'],
        priceInCents: $result['price_in_cents'],
        unit: $result['unit'],
        brand: $result['brand'],
        observation: $result['observation'],
        productType: (new ProductTypeRepository($this->conn))->findById($result['product_type_id']),
        id: $result['id']
      );
      $products[] = $product;
    }

    return $products;
  }
}