<?php

namespace App\Application\Product;

class UpdateProduct
{
  private ProductRepositoryInterface $productRepository;

  public function __construct(ProductRepositoryInterface $productRepository)
  {
    $this->productRepository = $productRepository;
  }


  public function execute(ProductDTO $dto): bool
  {
      return $this->productRepository->update($dto);
  }
}