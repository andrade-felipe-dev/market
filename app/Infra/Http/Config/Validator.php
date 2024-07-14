<?php

namespace App\Infra\Http\Config;

class Validator
{
  public static function validate(array $validations, array $fields)
  {
    foreach ($validations as $field => $rule) {
      if (empty(trim($fields[$field] && $rule === 'required'))) {
        throw new \Exception("The field ($field) is required.");
      }
    }

    return $fields;
  }
}