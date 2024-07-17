<?php

namespace App\Application\Sale;

use App\Core\Sale\Sale;

class CreateSale
{
  private SaleRepositoryInterface $saleRepository;

  public function __construct(SaleRepositoryInterface $saleRepository)
  {
    $this->saleRepository = $saleRepository;
  }

  public function execute(SaleDTO $dto): int
  {
    return $this->saleRepository->store($dto);
  }
}