<?php

namespace App\Application\Product;

use App\Core\Product;

class DeleteProduct
{
  private ProductRepositoryInterface $productRepository;

  public function __construct(ProductRepositoryInterface $productRepository)
  {
    $this->productRepository = $productRepository;
  }

  public function execute(Product $product): void
  {
    $this->productRepository->delete($product);
  }
}