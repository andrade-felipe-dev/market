<?php

namespace App\Application\SaleProduct;

use App\Core\SaleProduct\SaleProduct;

interface SaleProductRepositoryInterface
{
  public function store(SaleProductDTO $dto): ?int;
  public function delete(SaleProduct $sale): bool;
  public function findByIdSale(int $id): ?SaleProduct;
}