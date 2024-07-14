<?php

namespace App\Application\Product;

use App\Core\ProductType;

readonly class ProductDTO
{
    public int $id;

    public string $name;

    public string $description;

    public int $priceInCents;

    public string $unit;

    public string $brand;

    public string $observation;

    public ProductType $productType;
}