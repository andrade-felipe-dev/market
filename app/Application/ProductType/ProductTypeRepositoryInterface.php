<?php

namespace App\Application\ProductType;

use App\Core\ProductType;

interface ProductTypeRepositoryInterface
{
  public function store(ProductTypeDTO $dto): bool;
  public function update(ProductTypeDTO $dto): bool;
  public function delete(ProductType $product): bool;
  public function findById(int $id): ?ProductType;

  public function findAll(): array;
}