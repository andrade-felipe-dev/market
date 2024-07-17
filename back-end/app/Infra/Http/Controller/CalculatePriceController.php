<?php

namespace App\Infra\Http\Controller;;

use App\Application\SaleProduct\CalculatePrice;
use App\Infra\Http\Config\Request;
use App\Infra\Http\Config\Response;
use App\Infra\Http\Request\CalculatePriceRequest;

class CalculatePriceController
{
  public function calculate(Request $request, Response $response): void
  {
    $body = $request::body();
    $validateData = CalculatePriceRequest::validate($body);
    
    $value = (new CalculatePrice())->execute($validateData['quantity'], $validateData['priceInCents'], $validateData['tax']);

    $response::json([
      'error' => false,
      'success' => true,
      'data' => $value
    ]);

  }
}