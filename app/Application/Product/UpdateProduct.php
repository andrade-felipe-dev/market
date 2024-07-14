<?php

namespace App\Application\Product;

use App\Infra\Database\Product\ProductRepository;

class UpdateProduct
{
  private ProductRepository $productRepository;

  public function __construct(ProductRepository $productRepository)
  {
    $this->productRepository = $productRepository;
  }


  public function execute(ProductDTO $dto): bool
  {
      return $this->productRepository->update($dto);
  }
}