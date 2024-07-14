<?php

namespace App\Application\Sale;

use App\Core\Sale\Sale;

interface SaleRepositoryInterface
{
  public function store(SaleDTO $dto): bool;
  public function update(SaleDTO $dto): bool;
  public function delete(Sale $sale): bool;
  public function findById(int $id): ?Sale;

  public function findAll(): array;
}