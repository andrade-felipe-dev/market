<?php

namespace App\Core\ItemProduct;

use App\Core\Product;

class ItemProduct
{
    private int $quantity = 0;
    private Product $product;

    public function __construct($quantity, Product $product)
    {
        $this->quantity = $quantity;
        $this->product = $product;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    public function getTotalPrice(): int
    {
      $totalWithoutTax = $this->quantity * $this->product->getPriceInCents();
      $calculateTax =  ($this->product->getProductType()->getTax() / 100) * $totalWithoutTax;

      return $totalWithoutTax + $calculateTax;
    }
}