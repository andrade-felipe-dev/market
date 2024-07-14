<?php

namespace App\Application\Product;

use App\Core\Product;

interface ProductRepositoryInterface
{
    public function store(ProductDTO $dto): bool;
    public function update(ProductDTO $dto): bool;
    public function delete(Product $product): bool;
    public function findById(int $id): ?Product;

    public function findAll(): array;
}