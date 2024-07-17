<?php


use App\Application\ProductType\ProductTypeDTO;
use App\Application\ProductType\ProductTypeRepositoryInterface;
use App\Application\ProductType\UpdateProductType;

test('update product type and return true', function () {
  $mock = Mockery::mock(ProductTypeRepositoryInterface::class);
  $mock->shouldReceive('update')->andReturn(true);

  $dto = new ProductTypeDTO(
    name: 'produt 1',
    description: 'description 1',
    tax: 10,
    id: 3
  );

  $result = (new UpdateProductType($mock))->execute($dto);

  expect($result)->toBeTrue();
});

test('update product type and return false', function () {
  $mock = Mockery::mock(ProductTypeRepositoryInterface::class);
  $mock->shouldReceive('update')->andReturn(false);

  $dto = new ProductTypeDTO(
    name: 'produt 1',
    description: 'description 1',
    tax: 10,
    id: 3
  );

  $result = (new UpdateProductType($mock))->execute($dto);

  expect($result)->toBeFalse();
});