<?php

namespace App\Core\Sale;

use App\Core\SaleProduct\SaleProduct;
use App\Core\Product;
use App\Core\ProductType;
use PHPUnit\Framework\TestCase;

class SaleTest extends TestCase
{
  public function testShouldBeGetTotalPriceWithTax(): void
  {
//    $productType = new ProductType(
//      name: 'Product type 1',
//      descrption: 'description product type',
//      category: 'smartphone',
//      tax: 10
//    );
//
//    $productType2 = new ProductType(
//      name: 'Product type 1',
//      descrption: 'description product type',
//      category: 'smartphone',
//      tax: 5
//    );
//
//    $product = new Product(
//      name: 'product1',
//      description: 'product1 description',
//      priceInCents: 10000,
//      unit: 'UN',
//      brand: 'product1 brand name',
//      observation: '',
//      productType: $productType
//    );
//
//    $product2 = new Product(
//      name: 'product2',
//      description: 'product2 description',
//      priceInCents: 10000,
//      unit: 'UN',
//      brand: 'product1 brand name',
//      observation: '',
//      productType: $productType2
//    );
//
//    $itemProduct = new SaleProduct(
//      quantity: 1,
//      product: $product
//    );
//
//    $itemProduct2 = new SaleProduct(
//      quantity: 2,
//      product: $product2
//    );
//
//    $sale = new Sale();
//    $sale->addItemProduct($itemProduct);
//    $sale->addItemProduct($itemProduct2);
//
//    $this->assertEquals(32000, $sale->totalSale());
  }
}