<?php

namespace App\Application\SaleProduct;

use App\Core\Product;

class CalculatePrice
{
  public function __construct()
  {
  }

  public function execute(int $quantity, Product $product): int
  {
    $totalWithoutTax = $quantity * $product->getPriceInCents();
    $calculateTax = ($product->getProductType()->getTax() / 100) * $totalWithoutTax;

    return $totalWithoutTax + $calculateTax;
  }
}