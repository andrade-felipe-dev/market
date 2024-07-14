<?php

namespace App\Application\Sale;

readonly class SaleDTO
{
  public int $id;

  public int $priceInCents;

  public \DateTime $saleTime;
}