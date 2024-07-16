<?php

namespace App\Application\Sale;

class FindAllSale
{
  private SaleRepositoryInterface $saleRepository;

  public function __construct(SaleRepositoryInterface $saleRepository)
  {
    $this->saleRepository = $saleRepository;
  }

  public function execute(): array
  {
    return $this->saleRepository->findAll();
  }
}