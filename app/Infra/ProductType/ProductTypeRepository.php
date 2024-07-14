<?php

namespace App\Infra\ProductType;

use App\Application\ProductType\ProductTypeDTO;
use App\Application\ProductType\ProductTypeRepositoryInterface;
use App\Core\ProductType;
use App\Infra\Database;
use PDO;

class ProductTypeRepository implements ProductTypeRepositoryInterface
{
  private PDO $conn;

  public function __construct(PDO $conn)
  {
    $this->conn = $conn;
  }

  public function store(ProductTypeDTO $dto): bool
  {
    $sql = "INSERT INTO product_type (name, description, category, tax) VALUES (:name, :description, :category, :tax)";
    $stmt = $this->conn->prepare($sql);

    return $stmt->execute([
      ':name' => $dto->name,
      ':description' => $dto->description,
      ':category' => $dto->category,
      ':tax' => $dto->tax
    ]);
  }

  public function update(ProductTypeDTO $dto): bool
  {
    $sql = "UPDATE product_type SET name = :name, description = :description, category = :category, tax = :tax WHERE id = :id";
    $stmt = $this->conn->prepare($sql);

    return $stmt->execute([
      ':name' => $dto->name,
      ':description' => $dto->description,
      ':category' => $dto->category,
      ':tax' => $dto->tax,
      ':id' => $dto->id,
    ]);
  }


  public function delete(ProductType $product): bool
  {
    $sql = "DELETE FROM product_type WHERE id = :id";
    $stmt = $this->conn->prepare($sql);

    return $stmt->execute([
      ':id' => $product->getId()
    ]);
  }

  public function findById(int $id): ?ProductType
  {
    $sql = "SELECT * FROM product_type WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([':id' => $id]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result === false) {
      return null;
    }

    return new ProductType(
      name: $result['name'],
      description: $result['description'],
      category: $result['category'],
      tax: $result['tax'],
      id: $result['id']
    );
  }

  public function findAll(): array
  {
    $sql = "SELECT * FROM product_type";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $productTypes = [];
    foreach ($results as $result) {
      $productTypes[] = new ProductType(
        name: $result['name'],
        description: $result['description'],
        category: $result['category'],
        tax: $result['tax'],
        id: $result['id']
      );
    }

    return $productTypes;
  }
}