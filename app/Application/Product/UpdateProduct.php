<?php

namespace App\Application\Product;

use App\Core\Product;

class UpdateProduct
{
    public function __construct()
    {
    }


    public function execute(Product $product, ProductDTO $dto): Product
    {
        return new Product();
    }
}