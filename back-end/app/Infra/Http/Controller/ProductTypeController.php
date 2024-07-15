<?php

namespace App\Infra\Http\Controller;

use App\Application\ProductType\CreateProductType;
use App\Application\ProductType\DeleteProductType;
use App\Application\ProductType\FindAllProductType;
use App\Application\ProductType\FindProductType;
use App\Application\ProductType\ProductTypeDTO;
use App\Application\ProductType\UpdateProductType;
use App\Infra\Database\Database;
use App\Infra\Database\ProductType\ProductTypeRepository;
use App\Infra\Http\Config\Request;
use App\Infra\Http\Config\Response;
use App\Infra\Http\Request\ProductTypeRequest;

class ProductTypeController
{
  private ProductTypeRepository $productTypeRepository;

  public function __construct(Database $db)
  {
    $this->productTypeRepository = new ProductTypeRepository($db->getCon());
  }

  public function store(Request $request, Response $response): void
  {
    $body = $request::body();
    $validateData = ProductTypeRequest::create($body);

    if (isset($validateData['error'])) {
      $response::json([
        'error' => true,
        'success' => false,
        'message' => $validateData['error']
      ], 400);
      return;
    }

    $dto = new ProductTypeDTO(
      name: $validateData['name'],
      description: $validateData['description'],
      category: $validateData['category'],
      tax: $validateData['tax'],
    );

    try {
      (new CreateProductType($this->productTypeRepository))->execute($dto);
      $response::json([
        'error' => false,
        'success' => true,
        'message' => 'A Product Type was created.',
        'data' => []
      ], 201);
    } catch (\Exception $e) {
      $response::json([
        'error' => true,
        'success' => false,
        'message' => $e->getMessage()
      ], 400);
    }
  }

  public function update(Request $request, Response $response, array $urlParam): void
  {
    $body = $request::body();
    $validateData = ProductTypeRequest::update($body);
    $id = $urlParam[0];

    if (isset($validateData['error'])) {
      $response::json([
        'error' => true,
        'success' => false,
        'message' => $validateData['error']
      ], 400);
      return;
    }

    $dto = new ProductTypeDTO(
      name: $validateData['name'],
      description: $validateData['description'],
      category: $validateData['category'],
      tax: $validateData['tax'],
      id: $id,
    );
    try {
      $conn = new Database();
      (new UpdateProductType($this->productTypeRepository))->execute($dto);
      $response::json([
        'error' => false,
        'success' => true,
        'message' => 'A Product Type was updated.',
        'data' => []
      ]);
    } catch (\Exception $e) {
      $response::json([
        'error' => true,
        'success' => false,
        'message' => $e->getMessage()
      ], 400);
    }
  }

  public function find(Request $request, Response $response, array $urlParam): void
  {
    $id = $urlParam[0];

    try {
      $productType = (new FindProductType($this->productTypeRepository))->execute($id);
      if ($productType) {
        $response::json([
          'error' => false,
          'success' => true,
          'data' => $productType->getAttributes()
        ]);
        return;
      }
      $response::json(['error' => false,
        'success' => true,
        'data' => []
      ]);
    } catch (\Exception $e) {
      $response::json([
        'error' => true,
        'success' => false,
        'message' => $e->getMessage()
      ], 400);
    }
  }

  public function delete(Request $request, Response $response, array $urlParam): void
  {
    $id = $urlParam[0];

    try {
      $productType = (new FindProductType($this->productTypeRepository))->execute($id);
      if ($productType) {
        (new DeleteProductType($this->productTypeRepository))->execute($productType);
        $response::json([
          'error' => false,
          'success' => true,
          'data' => []
        ], 204);

        return;
      }

      $response::json([
        'error' => true,
        'success' => false,
        'data' => 'Product Type not found'
      ], 400);
    } catch (\Exception $e) {
      $response::json([
        'error' => true,
        'success' => false,
        'message' => $e->getMessage()
      ], 400);
    }
  }

  public function findAll(Request $request, Response $response): void
  {
    try {
      $productsType = (new FindAllProductType($this->productTypeRepository))->execute();

      $response::json([
        'error' => false,
        'success' => true,
        'data' => $productsType
      ]);
    } catch (\Exception $e) {
      $response::json([
        'error' => true,
        'success' => false,
        'message' => $e->getMessage()
      ], 400);
    }
  }
}