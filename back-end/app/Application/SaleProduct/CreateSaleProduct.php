<?php

namespace App\Application\SaleProduct;

use App\Core\SaleProduct\SaleProduct;

class CreateSaleProduct
{
  private SaleProductRepositoryInterface $saleProductRepository;


  public function __construct(SaleProductRepositoryInterface $saleProductRepository)
  {
    $this->saleProductRepository = $saleProductRepository;
  }

  public function execute(SaleProductDTO $dto): bool
  {
    return $this->saleProductRepository->store($dto);
  }
}