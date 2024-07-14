<?php

namespace App\Application\ProductType;

use App\Infra\Database\ProductType\ProductTypeRepository;

class UpdateProductType
{
  private ProductTypeRepository $productTypeRepository;

  public function __construct(ProductTypeRepository $productTypeRepository)
  {
    $this->productTypeRepository = $productTypeRepository;
  }


  public function execute(ProductTypeDTO $dto): bool
  {
      return $this->productTypeRepository->update($dto);
  }
}