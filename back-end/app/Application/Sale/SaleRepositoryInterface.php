<?php

namespace App\Application\Sale;

use App\Core\Sale;

interface SaleRepositoryInterface
{
  public function store(SaleDTO $dto): ?int;
  public function update(SaleDTO $dto): bool;
  public function delete(Sale $sale): bool;
  public function findById(int $id): ?Sale;

  public function findAll(): array;
}