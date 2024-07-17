<?php

namespace App\Application\SaleProduct;

use App\Application\SaleProduct\SaleProductRepositoryInterface;

class DeleteSaleProductByProductId
{
  private SaleProductRepositoryInterface $saleProductRepository;


  public function __construct(SaleProductRepositoryInterface $saleProductRepository)
  {
    $this->saleProductRepository = $saleProductRepository;
  }

  public function execute(int $id, int $saleId): bool
  {
    return $this->saleProductRepository->deleteByProductId($id, $saleId);
  }
}