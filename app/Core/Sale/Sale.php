<?php 
namespace App\Core\Sale;

use App\Core\ItemProduct\ItemProduct;

class Sale
{
  private array $totalProducts;

  public function __construct()
  {
  }

  public function addItemProduct(ItemProduct $itemProduct): void
  {
      $this->totalProducts[] = $itemProduct;
  }


  public function totalSale(): int
  {
    $total = 0;
    foreach ($this->totalProducts as $itemProduct) {
      $total += $itemProduct->getTotalPrice();
    }

    return $total;
  }
}