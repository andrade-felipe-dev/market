<?php


use App\Application\SaleProduct\CalculatePrice;

test('calculate price and return correct value', function () {
  $tax = 5;
  $value = 100;
  $quantity = 2;

  $result = (new CalculatePrice())->execute($quantity, $value, $tax);
  expect($result)->toEqual(210, $result);
});
