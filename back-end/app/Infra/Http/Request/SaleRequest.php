<?php

namespace App\Infra\Http\Request;

use App\Infra\Http\Config\Validator;

class SaleRequest
{
  public static function validate(array $data): array
  {
    try {
      return Validator::validate([
        'products' => 'required',
        'saleTime' => 'required',
      ], [
        'products' => $data['products'],
        'saleTime' => $data['saleTime'],
      ]);
    } catch (\Exception $e) {
      return [
        'error' => $e->getMessage(),
      ];
    }
  }
}