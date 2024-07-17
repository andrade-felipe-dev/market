<?php

namespace App\Infra\Http\Request;

use App\Infra\Http\Config\Validator;

class CalculatePriceRequest
{

  public static function validate(array $data): array
  {
    try{
      return Validator::validate([
        'quantity' => 'required',
        'priceInCents' => 'required',
        'tax' => 'required'
      ], [
        'quantity' => $data['quantity'] ?? '',
        'priceInCents' => $data['priceInCents'] ?? '',
        'tax' => $data['tax'] ?? '',
      ]);
    } catch (\Exception $e) {
      return [
        'error' => $e->getMessage()
      ];
    }
  }
}