<?php

namespace App\Infra\Database\Sale;

use App\Application\Sale\SaleDTO;
use App\Application\Sale\SaleRepositoryInterface;
use App\Core\Sale\Sale;
use Carbon\Carbon;

class SaleRepository implements SaleRepositoryInterface
{
  private \PDO $conn;

  public function __construct(\PDO $conn)
  {
    $this->conn = $conn;
  }

  public function store(SaleDTO $dto): ?int
  {
    $sql = "INSERT INTO sale(sale_time) VALUES (:saleTime)";
    $smt = $this->conn->prepare($sql);

    $success = $smt->execute([
      ':saleTime' => $dto->saleTime
    ]);

    if ($success) {
      $saleId = $this->conn->lastInsertId();
      return (int) $saleId;
    }

    return null;
  }

  public function update(SaleDTO $dto): bool
  {
    $sql = "UPDATE sale SET sale_time = :saleTime WHERE id = :id";
    $smt = $this->conn->prepare($sql);

    return $smt->execute([
      ':sale_time' => $dto->saleTime,
      ':id' => $dto->id
    ]);
  }

  public function delete(Sale $sale): bool
  {
    $sql = "DELETE FROM sale WHERE id = :id";
    $smt = $this->conn->prepare($sql);

    return $smt->execute([
      ':id' => $sale->getId()
    ]);
  }

  public function findById(int $id): ?Sale
  {
    $sql = "SELECT * FROM sale WHERE id = :id";
    $smt = $this->conn->prepare($sql);

    $smt->execute([
      ':id' => $id
    ]);
    $result = $smt->fetch(\PDO::FETCH_ASSOC);

    if (!$result) {
      return null;
    }

    return new Sale(
      saleTime: Carbon::createFromFormat('Y-m-d H:i:s', $result['sale_time']),
      id: $result['id'],
    );
  }

  public function findAll(): array
  {
    $sql = "SELECT * FROM sale";
    $smt = $this->conn->prepare($sql);

    $smt->execute();
    $results = $smt->fetchAll(\PDO::FETCH_ASSOC);
    $sales = [];
    foreach ($results as $result) {
      $sale = new Sale(
        saleTime: Carbon::createFromFormat('Y-m-d H:i:s', $result['sale_time']),
        id: $result['id']
      );

      $sales[] = $sale->getAttributes();
    }

    return $sales;
  }
}