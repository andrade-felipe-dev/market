<?php

use App\Application\ProductType\CreateProductType;
use App\Application\ProductType\ProductTypeDTO;
use App\Application\ProductType\ProductTypeRepositoryInterface;
use App\Core\ProductType;

test('test should be create a product type', function () {
  $mock = Mockery::mock(ProductTypeRepositoryInterface::class);
  $mock->shouldReceive('store')->andReturn(true);

  $dto = new ProductTypeDTO(
    name: 'produt 1',
    description: 'description 1',
    tax: 10,
  );

  $result = (new CreateProductType($mock))->execute($dto);
  expect($result)->toBeTrue();
});

test('test should be create a product type and return false', function () {
  $mock = Mockery::mock(ProductTypeRepositoryInterface::class);
  $mock->shouldReceive('store')->andReturn(false);

  $dto = new ProductTypeDTO(
    name: 'produt 1',
    description: 'description 1',
    tax: 10,
  );

  $result = (new CreateProductType($mock))->execute($dto);
  expect($result)->toBeFalse();
});