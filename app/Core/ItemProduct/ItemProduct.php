<?php

namespace App\Core\ItemProduct;

use App\Core\Product;

class ItemProduct
{
  private int $id;

  private int $quantity;
  private Product $product;

  public function __construct(Product $product, $id = 0, $quantity = 1)
  {
    $this->product = $product;
    $this->id = $id;
    $this->quantity = $quantity;
  }

  public function getId(): int
  {
    return $this->id;
  }

  public function setId(int $id): void
  {
    $this->id = $id;
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