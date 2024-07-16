<?php

namespace App\Application\SaleProduct;

class SaleProductDTO
{
  public int $saleId;

  public int $productId;

  public int $quantity;

  public int $priceInCents;

  public function __construct(int $saleId, int $productId, int $quantity, int $priceInCents = 0)
  {
    $this->saleId = $saleId;
    $this->productId = $productId;
    $this->quantity = $quantity;
    $this->priceInCents = $priceInCents;
  }
}