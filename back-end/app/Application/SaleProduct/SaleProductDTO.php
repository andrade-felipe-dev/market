<?php

namespace App\Application\SaleProduct;

readonly class SaleProductDTO
{
  public int $saleId;

  public int $productId;

  public int $quantity;

  public function __construct(int $saleId, int $productId, int $quantity)
  {
    $this->saleId = $saleId;
    $this->productId = $productId;
    $this->quantity = $quantity;
  }
}