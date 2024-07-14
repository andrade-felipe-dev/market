<?php

namespace App\Infra\Http\Request;

use App\Infra\Http\Config\Response;
use App\Infra\Http\Config\Validator;

class ProductTypeRequest
{
  public static function create($data): array
  {
    try{
      return Validator::validate([
        'name' => 'required',
        'tax' => 'required',
      ], [
        'name' => $data['name'] ?? '',
        'description' => $data['description'] ?? '',
        'tax' => $data['tax'] ?? '',
        'category' => $data['category'] ?? ''
      ]);
    } catch (\Exception $e) {
      return [
        'error' => $e->getMessage()
      ];
    }
  }

  public static function update($data): array
  {
    try{
      return Validator::validate([
        'name' => 'required',
        'tax' => 'required',
      ], [
        'name' => $data['name'] ?? '',
        'description' => $data['description'] ?? '',
        'tax' => $data['tax'] ?? '',
        'category' => $data['category'] ?? ''
      ]);
    } catch (\Exception $e) {
      return [
        'error' => $e->getMessage()
      ];
    }
  }
}
