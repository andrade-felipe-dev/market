<?php 
namespace App\Core;

class Sale
{
  private int $id;

  private \DateTime $saleTime;

  public function __construct(\DateTime $saleTime, int $id = 0)
  {
    $this->saleTime = $saleTime;
    $this->id = $id;
  }

  public function getId(): int
  {
    return $this->id;
  }

  public function setId(int $id): void
  {
    $this->id = $id;
  }

  public function getSaleTime(): \DateTime
  {
    return $this->saleTime;
  }

  public function setSaleTime(\DateTime $saleTime): void
  {
    $this->saleTime = $saleTime;
  }

  public function getAttributes(): array
  {
    return [
      'id' => $this->id,
      'saleTime' => $this->saleTime
    ];
  }
}