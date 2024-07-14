<?php

namespace App\Application\ProductType;

use App\Core\Product;
use App\Core\ProductType;
use App\Infra\Product\ProductRepository;
use App\Infra\ProductType\ProductTypeRepository;

class DeleteProductType
{
  private ProductTypeRepository $productTypeRepository;

  public function __construct(ProductTypeRepository $productTypeRepository)
  {
    $this->productTypeRepository = $productTypeRepository;
  }

  public function execute(ProductType $productType): void
  {
    $this->productTypeRepository->delete($productType);
  }
}