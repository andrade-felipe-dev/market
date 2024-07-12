<?php

namespace App\Application\ProductType;

readonly class ProductTypeDTO
{
  public int $id;
  public string $name;

  public string $description;

  public string $category;

  public int $tax;

  public function __construct(int $id, string $name, string $description, string $category, int $tax)
  {
    $this->id = $id;
    $this->name = $name;
    $this->description = $description;
    $this->category = $category;
    $this->tax = $tax;
  }
}