<?php

namespace App\Application\ProductType;

class UpdateProductType
{
  private ProductTypeRepositoryInterface $productTypeRepository;

  public function __construct(ProductTypeRepositoryInterface $productTypeRepository)
  {
    $this->productTypeRepository = $productTypeRepository;
  }


  public function execute(ProductTypeDTO $dto): bool
  {
      return $this->productTypeRepository->update($dto);
  }
}