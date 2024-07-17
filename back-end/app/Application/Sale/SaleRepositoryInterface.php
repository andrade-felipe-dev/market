<?php

namespace App\Application\Sale;

use App\Core\Sale\Sale;

interface SaleRepositoryInterface
{
  public function store(SaleInputDTO $dto): ?int;
  public function update(SaleInputDTO $dto): bool;
  public function delete(Sale $sale): bool;
  public function findById(int $id): ?Sale;

  public function findAll(): array;
}