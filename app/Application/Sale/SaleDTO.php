<?php

namespace App\Application\Sale;

readonly class SaleDTO
{
  public int $id;

  public \DateTime $saleTime;

  public array $saleProducts;

  public function __construct(\DateTime $saleTime, array $saleProducts,int $id = 0)
  {
    $this->id = $id;
    $this->saleTime = $saleTime;
    $this->saleProducts = $saleProducts;
  }
}