<?php

namespace App\Application\Product;

class CreateProduct
{
  private ProductRepositoryInterface $productRepository;

  public function __construct(ProductRepositoryInterface $productRepository)
  {
    $this->productRepository = $productRepository;
  }

  public function execute(ProductDTO $dto): bool
  {
    return $this->productRepository->store($dto);
  }
}