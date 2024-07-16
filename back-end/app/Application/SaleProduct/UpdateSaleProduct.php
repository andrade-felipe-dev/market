<?php

namespace App\Application\SaleProduct;

class UpdateSaleProduct
{
  private SaleProductRepositoryInterface $saleProductRepository;


  public function __construct(SaleProductRepositoryInterface $saleProductRepository)
  {
    $this->saleProductRepository = $saleProductRepository;
  }

  public function execute(SaleProductDTO $dto): bool
  {
    return $this->saleProductRepository->updateByProductId($dto);
  }
}