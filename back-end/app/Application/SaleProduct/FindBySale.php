<?php

namespace App\Application\SaleProduct;

use App\Core\Sale\Sale;

class FindBySale
{
  private SaleProductRepositoryInterface $saleProductRepository;


  public function __construct(SaleProductRepositoryInterface $saleProductRepository)
  {
    $this->saleProductRepository = $saleProductRepository;
  }

  public function execute(Sale $sale) {
    $this->saleProductRepository->findByIdSale($sale);
  }

}