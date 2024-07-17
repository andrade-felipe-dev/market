<?php

namespace App\Infra\Database\SaleProductRepository;

use App\Application\SaleProduct\SaleProductDTO;
use App\Application\SaleProduct\SaleProductRepositoryInterface;
use App\Core\Sale;
use App\Core\SaleProduct;
use App\Infra\Database\Product\ProductRepository;

class SaleProductRepository implements SaleProductRepositoryInterface
{
  private \PDO $conn;

  public function __construct(\PDO $conn)
  {
    $this->conn = $conn;
  }

  public function store(SaleProductDTO $dto): bool
  {
    $sql = "INSERT INTO sale_product (product_id, sale_id, quantity, price_in_cents) 
                VALUES (:product_id, :sale_id, :quantity, :priceInCents)";
    $stmt = $this->conn->prepare($sql);

    return $stmt->execute([
      ':product_id' => $dto->productId,
      ':sale_id' => $dto->saleId,
      ':quantity' => $dto->quantity,
      ':priceInCents' => $dto->priceInCents,
    ]);
  }

  public function updateByProductId(SaleProductDTO $dto): bool
  {
    $sql = "UPDATE sale_product SET 
                        quantity = :quantity,
                        price_in_cents = :priceInCents
                    WHERE product_id = :productId";
    $stmt = $this->conn->prepare($sql);

    return $stmt->execute([
      ':quantity' => $dto->quantity,
      ':priceInCents' => $dto->priceInCents,
      ':productId' => $dto->productId
    ]);
  }


  public function deleteBySale(Sale $sale): bool
  {
    $sql = "DELETE FROM sale_product WHERE sale_id = :saleId";
    $stmt = $this->conn->prepare($sql);

    return $stmt->execute([
      ':saleId' => $sale->getId()
    ]);
  }

  public function findBySaleId(int $id): array
  {
    try {
      $sql = "SELECT * FROM sale_product WHERE sale_id = :saleId";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([':saleId' => $id]);

      $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      $saleProducts = [];

      $productRepository = new ProductRepository($this->conn);

      foreach ($results as $result) {
        $product = $productRepository->findById($result['product_id']);

        if ($product) {
          $saleProduct = new SaleProduct(
            product: $product,
            priceInCents: $result['price_in_cents'],
            id: $result['id'],
            quantity: $result['quantity']
          );

          $saleProducts[] = $saleProduct;
        }
      }

      return $saleProducts;
    } catch (\PDOException $e) {
      error_log("PDOException: " . $e->getMessage());
      return [];
    }
  }

  public function deleteByProductId(int $id, int $saleId): bool
  {
    $sql = "DELETE FROM sale_product WHERE product_id = :productId AND sale_id = :saleId";
    $stmt = $this->conn->prepare($sql);

    return $stmt->execute([
      ':productId' => $id,
      ':saleId' => $saleId
    ]);
  }
}