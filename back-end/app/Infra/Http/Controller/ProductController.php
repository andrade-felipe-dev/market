<?php

namespace App\Infra\Http\Controller;

use App\Application\Product\CreateProduct;
use App\Application\Product\DeleteProduct;
use App\Application\Product\FindAllProduct;
use App\Application\Product\FindProduct;
use App\Application\Product\ProductDTO;
use App\Application\Product\UpdateProduct;
use App\Infra\Database\Database;
use App\Infra\Database\Product\ProductRepository;
use App\Infra\Http\Config\Request;
use App\Infra\Http\Config\Response;
use App\Infra\Http\Request\ProductRequest;

class ProductController
{
  public function store(Request $request, Response $response): void
  {
    $body = $request::body();
    $validateData = ProductRequest::validate($body);
    if (isset($validateData['error'])) {
      $response::json([
        'error' => true,
        'success' => false,
        'message' => $validateData['error']
      ], 400);
      return;
    }

    $dto = new ProductDTO(
      name: $body['name'],
      description: $body['description'],
      priceInCents: $body['priceInCents'],
      unit: $body['unit'],
      brand: $body['brand'],
      observation: $body['observation'],
      productTypeId: $body['productTypeId']
    );

    try {
      $conn = new Database();
      $repository = new ProductRepository($conn->getCon());
      (new CreateProduct($repository))->execute($dto);

      $response::json([
        'error' => false,
        'success' => true,
        'message' => 'Product was created!',
        'data' => []
      ], 201);
    } catch (\Exception $e) {
      $response::json([
        'error' => true,
        'success' => false,
        'message'=> $e->getMessage()
      ]);
    }
  }

  public function update(Request $request, Response $response, array $urlParam): void
  {
    $body = $request::body();
    $validateData = ProductRequest::validate($body);
    $id = $urlParam[0];

    if (isset($validateData['error'])) {
      $response::json([
        'error' => true,
        'success' => false,
        'message' => $validateData['error']
      ], 400);
      return;
    }

    $dto = new ProductDTO(
      name: $body['name'],
      description: $body['description'],
      priceInCents: $body['priceInCents'],
      unit: $body['unit'],
      brand: $body['brand'],
      observation: $body['observation'],
      productTypeId: $body['productTypeId'],
      id: $id
    );

    try {
      $conn = new Database();
      $repository = new ProductRepository($conn->getCon());
      (new UpdateProduct($repository))->execute($dto);

      $response::json([
        'error' => false,
        'success' => true,
        'message' => 'Product was updated!',
        'data' => []
      ]);
    } catch (\Exception $e) {
      $response::json([
        'error' => true,
        'success' => false,
        'message'=> $e->getMessage()
      ]);
    }
  }

  public function find(Request $request, Response $response, array $urlParam): void
  {
    $id = $urlParam[0];

    try {
      $conn = new Database();
      $repository = new ProductRepository($conn->getCon());
      $product = (new FindProduct($repository))->execute($id);

      if ($product) {
        $response::json([
          'error' => false,
          'success' => true,
          'data' => $product->getAttributes()
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
      $conn = new Database();
      $repository = new ProductRepository($conn->getCon());
      $product = (new FindProduct($repository))->execute($id);

      if ($product) {
        (new DeleteProduct($repository))->execute($product);
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
        'data' => 'Product not found!'
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
      $conn = new Database();
      $repository = new ProductRepository($conn->getCon());
      $products = (new FindAllProduct($repository))->execute();

      $response::json([
        'error' => false,
        'success' => true,
        'data' => $products
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