<?php

namespace App\Core\ItemProduct;

use App\Core\Product;
use App\Core\ProductType;
use PHPUnit\Framework\TestCase;

class ItemProductTest extends TestCase
{
  public function testShouldBeGetTotalPriceWithTax(): void
  {
    $productType = new ProductType(
      name: 'Product type 1',
      descrption: 'description product type',
      category: 'smartphone',
      tax: 10
    );

    $product = new Product(
      name: 'product1',
      description: 'product1 description',
      priceInCents: 10000,
      unit: 'UN',
      brand: 'product1 brand name',
      observation: '',
      productType: $productType
    );

    $itemProduct = new ItemProduct(
      quantity: 1,
      product: $product
    );

    $this->assertEquals(11000, $itemProduct->getTotalPrice());
  }
}