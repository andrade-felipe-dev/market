<?php

namespace App\Application\SaleProduct;

use App\Core\Product;

class CalculatePrice
{
  public function __construct()
  {
  }

  public function execute(int $quantity, int $price, int $tax): int
  {
    $totalWithoutTax = $quantity * $price;
    $calculateTax = ($tax / 100) * $totalWithoutTax;

    return $totalWithoutTax + $calculateTax;
  }
}