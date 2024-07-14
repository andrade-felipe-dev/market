<?php

namespace App\Application\ProductType;

use App\Core\ProductType;
use App\Infra\Database\ProductType\ProductTypeRepository;

class DeleteProductType
{
  private ProductTypeRepositoryInterface $productTypeRepository;

  public function __construct(ProductTypeRepositoryInterface $productTypeRepository)
  {
    $this->productTypeRepository = $productTypeRepository;
  }

  public function execute(ProductType $productType): void
  {
    $this->productTypeRepository->delete($productType);
  }
}