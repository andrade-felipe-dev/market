<?php

namespace App\Application\ProductType;

use App\Infra\Database\ProductType\ProductTypeRepository;

class FindAllProductType
{
  private ProductTypeRepository $productTypeRepository;

  public function __construct(ProductTypeRepository $productTypeRepository)
  {
    $this->productTypeRepository = $productTypeRepository;
  }

  public function execute(): array
  {
    return $this->productTypeRepository->findAll();
  }
}