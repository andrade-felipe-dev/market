<?php

namespace App\Infra\ProductType;

use App\Application\ProductType\ProductTypeDTO;
use App\Application\ProductType\ProductTypeInterface;
use App\Core\ProductType;
use App\Infra\Database;
use PDO;

class ProductTypeRepository implements ProductTypeInterface
{
  private PDO $conn;

  public function __construct(Database $database)
  {
    $this->conn = $database->getCon();
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
    return false;
  }

  public function delete(ProductTypeDTO $product): bool
  {
    return false;
  }

  public function findById(int $id): ?ProductType
  {
    return null;
  }

  public function list(): array
  {
//    $sql = "SELECT * FROM product_type";
//    $stmt = $this->conn->prepare($sql);
//    $rows = $stmt->fetchAll(PDO::FETCH_CLASS, ProductType::class);
//    $productTypes = [];
//
//    foreach ($rows as $row) {
//      $productType = new ProductType(
//
//      );
//    }

    return [];
  }

}