<?php

namespace App\Application\Product;

use App\Core\ProductType;

class ProductDTO
{
    public readonly int $id;

    public readonly string $name;

    public readonly string $description;

    public readonly int $priceInCents;

    public readonly string $unit;

    public readonly string $brand;

    public readonly string $observation;

    public readonly ProductType $productType;
}