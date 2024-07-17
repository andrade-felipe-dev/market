<?php

namespace App\Infra\Http\Controller;

use App\Application\Sale\CreateSale;
use App\Application\Sale\DeleteSale;
use App\Application\Sale\FindAllSale;
use App\Application\Sale\SaleInputDTO;
use App\Application\Sale\UpdateSale;
use App\Application\SaleProduct\CalculatePrice;
use App\Application\SaleProduct\CreateSaleProduct;
use App\Application\SaleProduct\DeleteSaleProductByProductId;
use App\Application\SaleProduct\DeleteSaleProductBySale;
use App\Application\SaleProduct\FindBySaleId;
use App\Application\SaleProduct\SaleProductDTO;
use App\Application\SaleProduct\UpdateSaleProduct;
use App\Infra\Database\Database;
use App\Infra\Database\Product\ProductRepository;
use App\Infra\Database\Sale\SaleRepository;
use App\Infra\Database\SaleProductRepository\SaleProductRepository;
use App\Infra\Http\Config\Request;
use App\Infra\Http\Config\Response;
use App\Infra\Http\Request\SaleRequest;
use Carbon\Carbon;

class SaleController
{
  private SaleRepository $saleRepository;
  private SaleProductRepository $saleProductRepository;

  private ProductRepository $productRepository;

  public function __construct(Database $db)
  {
    $this->saleRepository = new SaleRepository($db->getCon());
    $this->saleProductRepository = new SaleProductRepository($db->getCon());
    $this->productRepository = new ProductRepository($db->getCon());
  }

  public function store(Request $request, Response $response): void
  {
    $body = $request::body();
    $validateData = SaleRequest::validate($body);

    if (isset($validateData['error'])) {
      $response::json([
        'error' => true,
        'success' => false,
        'message' => $validateData['error']
      ], 400);
      return;
    }

    try {
      $dto = new SaleInputDTO(
        saleTime: Carbon::createFromFormat('Y-m-d H:i:s', $validateData['saleTime']),
        saleProducts: $validateData['products']
      );
      $saleId = (new CreateSale($this->saleRepository))->execute($dto);

      foreach ($validateData['products'] as $productData) {
        $product = $this->productRepository->findById($productData['id']);

        $productDTO = new SaleProductDTO(
          saleId: $saleId,
          productId: $product->getId(),
          quantity: $productData['quantity'],
          priceInCents: (new CalculatePrice())->execute($productData['quantity'], $product->getPriceInCents(), $product->getProductType()->getTax())
        );

        (new CreateSaleProduct($this->saleProductRepository))->execute($productDTO);
      }

      $response::json([
        'error' => false,
        'success' => true,
        'message' => 'Sale was created!',
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
    $validateData = SaleRequest::validate($body);
    $id = $urlParam[0];

    if (isset($validateData['error'])) {
      $response::json([
        'error' => true,
        'success' => false,
        'message' => $validateData['error']
      ], 400);
      return;
    }

    try {
      $dto = new SaleInputDTO(
        saleTime: Carbon::createFromFormat('Y-m-d H:i:s', $validateData['saleTime']),
        saleProducts: $validateData['products'],
        id: $id
      );

      (new UpdateSale($this->saleRepository))->execute($dto);

      $saleProducts = (new FindBySaleId($this->saleProductRepository))->execute($id);
      $productsIdsExists = [];
      foreach ($saleProducts as $saleProduct) {
        $productsIdsExists[] = $saleProduct->getProduct()->getId();
      }
      $productIds = array_column($validateData['products'], 'id');
      $diff = array_diff($productIds, $productsIdsExists);

      foreach ($diff as $productId) {
        (new DeleteSaleProductByProductId($this->saleProductRepository))->execute($productId, $id);
      }
      
      foreach ($validateData['products'] as $productData) {
        $product = $this->productRepository->findById($productData['id']);

        $dto = new SaleProductDTO(
          saleId: $id,
          productId: $productData['id'],
          quantity: $productData['quantity'],
          priceInCents: (new CalculatePrice())->execute($productData['quantity'], $product->getPriceInCents(), $product->getProductType()->getTax())
        );
        (new UpdateSaleProduct($this->saleProductRepository))->execute($dto);
      }

      $response::json([
        'error' => false,
        'success' => true,
        'message' => 'Sale was updated!',
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

  public function findByIdSale(Request $request, Response $response, array $urlParam): void
  {
    $id = $urlParam[0];

    try {
      $sale = $this->saleRepository->findById($id);
      if($sale) {
        $saleProducts = $this->saleProductRepository->findBySaleId($id);
        $saleAttributes = [];
        foreach ($saleProducts as $saleProduct) {
          $saleAttributes[] = $saleProduct->getAttributes();
        }

        $response::json([
          'error' => false,
          'success' => true,
          'data' => [
            'saleProducts' => $saleAttributes,
            ...$sale->getAttributes()
          ]
        ]);
        return;
      }

      $response::json([
        'error' => false,
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

  public function findAll(Request $request, Response $response): void
  {
    try {
      $sales = (new FindAllSale($this->saleRepository))->execute();

      $response::json([
        'error' => false,
        'success' => true,
        'data' => $sales
      ]);
    } catch (\Exception $e) {
      $response::json([
        'error' => true,
        'success' => false,
        'message' => $e->getMessage()
      ], 400);
    }
  }

  public function deleteByIdSale(Request $request, Response $response, array $urlParam): void
  {
    $id = $urlParam[0];
    try {
      $sale = $this->saleRepository->findById($id);
      if($sale) {
        (new DeleteSaleProductBySale($this->saleProductRepository))->execute($sale);

        (new DeleteSale($this->saleRepository))->execute($sale);

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
        'message' => 'Sale not found'
      ], 400);
    } catch (\Exception $e) {
      $response::json([
        'error' => true,
        'success' => false,
        'message' => $e->getMessage()
      ]);
    }
  }
}