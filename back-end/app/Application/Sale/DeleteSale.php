<?php

namespace App\Application\Sale;

use App\Core\Sale;

class DeleteSale
{
  private SaleRepositoryInterface $saleRepository;

  public function __construct(SaleRepositoryInterface $saleRepository)
  {
    $this->saleRepository = $saleRepository;
  }

  public function execute(Sale $sale): bool
  {
    return $this->saleRepository->delete($sale);
  }
}