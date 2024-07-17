<?php

namespace App\Application\SaleProduct;

use App\Core\Sale\Sale;
use App\Core\SaleProduct\SaleProduct;

interface SaleProductRepositoryInterface
{
  public function store(SaleProductDTO $dto): bool;

  public function updateByProductId(SaleProductDTO $dto): bool;

  public function deleteBySale(Sale $sale): bool;

  public function findBySaleId(int $id): array;
  public function deleteByProductId(int $id, int $saleId): bool;
}