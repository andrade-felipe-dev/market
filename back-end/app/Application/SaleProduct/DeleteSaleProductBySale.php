<?php

namespace App\Application\SaleProduct;

use Core\Sale;

class DeleteSaleProductBySale
{
  private SaleProductRepositoryInterface $saleProductRepository;


  public function __construct(SaleProductRepositoryInterface $saleProductRepository)
  {
    $this->saleProductRepository = $saleProductRepository;
  }

  public function execute(Sale $sale) {
    $this->saleProductRepository->deleteBySale($sale);
  }
}