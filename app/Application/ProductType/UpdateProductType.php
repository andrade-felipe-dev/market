<?php

namespace App\Application\Product;

use App\Application\ProductType\ProductTypeDTO;
use App\Core\Product;
use App\Infra\Product\ProductRepository;
use App\Infra\ProductType\ProductTypeRepository;

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