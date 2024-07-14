<?php

namespace App\Infra\Http\Controller;

use App\Application\Sale\CreateSale;
use App\Application\Sale\SaleDTO;
use App\Infra\Database\Database;
use App\Infra\Database\Sale\SaleRepository;
use App\Infra\Http\Config\Request;
use App\Infra\Http\Config\Response;
use App\Infra\Http\Request\SaleRequest;

class SaleController
{
  public function store(Request $request, Response $response)
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

    $dto = new SaleDTO(
      saleTime: $validateData['saleTime'],
      saleProducts: $validateData['products']
    );

    try {
      $conn = new Database();
      $repository = new SaleRepository($conn->getCon());
      (new CreateSale($repository))->execute($dto);
      foreach ($dto->saleProducts as $product) {

      }
    } catch (\Exception $e) {
      $response::json([
        'error' => true,
        'success' => false,
        'message' => $e->getMessage()
      ]);
    }


  }

}