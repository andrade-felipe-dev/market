<?php

namespace App\Application\Sale;

readonly class SaleOutputDTO
{

  public int $id;

  public \DateTime $saleTime;


  public int $priceInCents;

  public function __construct(\DateTime $saleTime,int $priceInCents, int $id = 0)
  {
    $this->id = $id;
    $this->saleTime = $saleTime;
    $this->priceInCents = $priceInCents;
  }

  public function getAttributes(): array
  {
    return [
      'id' => $this->id,
      'saleTime' => $this->saleTime,
      'priceInCents' => $this->priceInCents,
    ];
  }
}