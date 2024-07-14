<?php

namespace App\Application\Product;

use App\Core\Product;

class FindProduct
{
  private ProductRepositoryInterface $productRepository;

  public function __construct(ProductRepositoryInterface $productRepository)
  {
    $this->productRepository = $productRepository;
  }

  public function execute(int $id): ?Product
  {
    return $this->productRepository->findById($id);
  }
}