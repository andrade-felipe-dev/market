<?php
namespace App\Core\SaleProduct;

use App\Core\Product;

class SaleProduct
{
  private int $id;

  private int $quantity;
  private Product $product;

  private int $priceInCents;

  public function __construct(Product $product,int $priceInCents, $id = 0, $quantity = 1)
  {
    $this->product = $product;
    $this->id = $id;
    $this->quantity = $quantity;
    $this->priceInCents = $priceInCents;
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

  public function getPriceInCents(): int
  {
    return $this->priceInCents;
  }

  public function setPriceInCents(int $priceInCents): void
  {
    $this->priceInCents = $priceInCents;
  }
}