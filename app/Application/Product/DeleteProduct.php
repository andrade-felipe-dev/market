<?php

namespace App\Application\Product;

use App\Core\Product;
use App\Infra\Product\ProductRepository;

class DeleteProduct
{
  private ProductRepository $productRepository;

  public function __construct(ProductRepository $productRepository)
  {
    $this->productRepository = $productRepository;
  }

  public function execute(Product $product): void
  {
    $this->productRepository->delete($product);
  }
}