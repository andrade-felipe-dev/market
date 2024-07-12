<?php

namespace App\Application\ProductType;

use App\Core\ProductType;

interface ProductTypeInterface
{
  public function store(ProductTypeDTO $dto): bool;
  public function update(ProductTypeDTO $dto): bool;
  public function delete(ProductTypeDTO $product): bool;
  public function findById(int $id): ?ProductType;

  public function list(): array;
}