<?php

require_once __DIR__ . '/vendor/autoload.php';
use App\Application\ProductType\ProductTypeDTO;
use App\Infra\Database;
use App\Infra\ProductType\ProductTypeRepository;

try {
  $db = new Database();
  $productTypeRepository = new ProductTypeRepository($db);

  $dto = new ProductTypeDTO(
    id: 0,
    name: 'type1',
    description: 'description1',
    category: 'category1',
    tax: 10
  );

  $result = $productTypeRepository->store($dto);

  echo $result;
} catch (Exception $e) {
  echo "Erro: " . $e->getMessage();
}
