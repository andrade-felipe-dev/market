<?php

namespace App\Application\ProductType;

class FindAllProductType
{
  private ProductTypeRepositoryInterface $productTypeRepository;

  public function __construct(ProductTypeRepositoryInterface $productTypeRepository)
  {
    $this->productTypeRepository = $productTypeRepository;
  }

  public function execute(): array
  {
    return $this->productTypeRepository->findAll();
  }
}