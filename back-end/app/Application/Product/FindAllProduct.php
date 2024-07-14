<?php

namespace App\Application\Product;

class FindAllProduct
{
  private ProductRepositoryInterface $productRepository;

  public function __construct(ProductRepositoryInterface $productRepository)
  {
    $this->productRepository = $productRepository;
  }

  public function execute(): array
  {
    return $this->productRepository->findAll();
  }
}