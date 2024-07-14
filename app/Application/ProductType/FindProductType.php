<?php

namespace App\Application\ProductType;

use App\Core\ProductType;

class FindProductType
{
  private ProductTypeRepositoryInterface $productTypeRepository;

  public function __construct(ProductTypeRepositoryInterface $productTypeRepository)
  {
    $this->productTypeRepository = $productTypeRepository;
  }

  public function execute(int $id): ?ProductType
  {
    return $this->productTypeRepository->findById($id);
  }
}