<?php

namespace App\Application\ProductType;

use App\Core\ProductType;
use App\Infra\Database\ProductType\ProductTypeRepository;

class FindProductType
{
  private ProductTypeRepository $productTypeRepository;

  public function __construct(ProductTypeRepository $productTypeRepository)
  {
    $this->productTypeRepository = $productTypeRepository;
  }

  public function execute(int $id): ?ProductType
  {
    return $this->productTypeRepository->findById($id);
  }
}