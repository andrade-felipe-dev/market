<?php

namespace App\Application\ProductType;

use App\Infra\ProductType\ProductTypeRepository;

class CreateProductType
{
  private ProductTypeRepository $productTypeRepository;

  public function __construct(ProductTypeRepository $productTypeRepository)
  {
    $this->productTypeRepository = $productTypeRepository;
  }

  public function execute(ProductTypeDTO $dto): bool
  {
    return $this->productTypeRepository->store($dto);
  }
}