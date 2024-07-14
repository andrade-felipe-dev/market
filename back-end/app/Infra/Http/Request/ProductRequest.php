<?php

namespace App\Infra\Http\Request;

use App\Infra\Http\Config\Validator;

class ProductRequest
{
  public static function validate(array $data): array
  {
    try{
      return Validator::validate([
        'name' => 'required',
        'priceInCents' => 'required',
        'productTypeId' => 'required'
      ], [
        'name' => $data['name'],
        'description' => $data['description'],
        'priceInCents' => $data['priceInCents'],
        'unit' => $data['unit'],
        'brand' => $data['brand'],
        'observation' => $data['observation'],
        'productTypeId' => $data['productTypeId']
      ]);
    } catch (\Exception $e) {
      return [
        'error' => $e->getMessage()
      ];
    }
  }

}