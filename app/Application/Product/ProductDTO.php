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

    public int $productTypeId;

  public function __construct(
    string $name, string $description, int $priceInCents, string $unit,
    string $brand, string $observation, int $productTypeId, int $id = 0
  )
  {
    $this->id = $id;
    $this->name = $name;
    $this->description = $description;
    $this->priceInCents = $priceInCents;
    $this->unit = $unit;
    $this->brand = $brand;
    $this->observation = $observation;
    $this->productTypeId = $productTypeId;
  }
}