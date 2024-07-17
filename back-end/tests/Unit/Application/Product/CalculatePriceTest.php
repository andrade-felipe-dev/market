<?php

use App\Application\SaleProduct\CalculatePrice;
use App\Core\Product;
use App\Core\ProductType;

test('should be pass a tax and price and return calculate value', function () {
  $product = new Product(
    name: 'teste1',
    description: 'description',
    priceInCents: 100,
    unit: 'test1',
    brand: 'teste',
    observation: 'obs',
    productType: new ProductType(
      name: 'teste tipo',
      description: 'description',
      tax: 5
    )
  );

  $calculate = (new CalculatePrice())->execute(2, $product);

  expect($calculate)->toBe(210);
});