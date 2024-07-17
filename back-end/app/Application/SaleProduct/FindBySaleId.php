<?php

namespace App\Application\SaleProduct;

class FindBySaleId
{
  private SaleProductRepositoryInterface $saleProductRepository;


  public function __construct(SaleProductRepositoryInterface $saleProductRepository)
  {
    $this->saleProductRepository = $saleProductRepository;
  }

  public function execute(int $id): array
  {
    return $this->saleProductRepository->findBySaleId($id);
  }
}