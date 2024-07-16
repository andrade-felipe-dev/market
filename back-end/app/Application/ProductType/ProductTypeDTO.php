<?php

namespace App\Application\ProductType;

readonly class ProductTypeDTO
{
  public int $id;
  public string $name;

  public string $description;
  public int $tax;

  public function __construct(string $name, string $description, int $tax, int $id = 0)
  {
    $this->id = $id;
    $this->name = $name;
    $this->description = $description;
    $this->tax = $tax;
  }
}