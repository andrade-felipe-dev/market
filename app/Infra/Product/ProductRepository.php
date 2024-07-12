<?php

namespace App\Infra\Product;

use App\Application\Product\ProductDTO;
use App\Application\Product\ProductRepositoryInterface;
use App\Core\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function store(ProductDTO $dto): bool
    {

    }

    public function update(ProductDTO $dto): bool
    {
        // TODO: Implement update() method.
    }

    public function delete(ProductDTO $product): bool
    {
        // TODO: Implement delete() method.
    }

    public function findById(int $id): ?Product
    {
        // TODO: Implement findById() method.
    }

    public function list(): array
    {
        // TODO: Implement list() method.
    }
}