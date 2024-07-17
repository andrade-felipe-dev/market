<?php


use App\Application\ProductType\CreateProductType;
use App\Application\ProductType\ProductTypeDTO;
use App\Application\ProductType\ProductTypeRepositoryInterface;

test('test should be pass parameter correct and return true', function () {
  $mock = Mockery::mock(ProductTypeRepositoryInterface::class);
  $mock->shouldReceive('store')->andReturn(true);

  $dto = new ProductTypeDTO(
    name: 'test',
    description: 'test description',
    tax: 5
  );

  $result = (new CreateProductType($mock))->execute($dto);

  expect($result)->toBeTrue();
});
