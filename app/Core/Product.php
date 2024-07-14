<?php 
namespace App\Core;

use \App\Core\ProductType;

class Product 
{
  private int $id;

  private string $name;

  private string $description;

  private int $priceInCents;

  private string $unit;

  private string $brand;

  private string $observation;

  private ProductType $productType;

  public function __construct(string $name, string $description, int $priceInCents, string $unit, string $brand, string $observation, ProductType $productType, int $id = 0)
  {
      $this->name = $name;
      $this->description = $description;
      $this->priceInCents = $priceInCents;
      $this->unit = $unit;
      $this->brand = $brand;
      $this->observation = $observation;
      $this->productType = $productType;
      $this->id = $id;
  }

  public function getId(): int
  {
    return $this->id;
  }

  public function setId(int $id): void
  {
    $this->id = $id;
  }

  public function getName(): string
  {
      return $this->name;
  }

  public function setName(string $name): void
  {
      $this->name = $name;
  }

  public function getDescription(): string
  {
      return $this->description;
  }

  public function setDescription(string $description): void
  {
      $this->description = $description;
  }

  public function getPriceInCents(): int
  {
      return $this->priceInCents;
  }

  public function setPriceInCents(int $priceInCents): void
  {
      $this->priceInCents = $priceInCents;
  }

  public function getUnit(): string
  {
      return $this->unit;
  }

  public function setUnit(string $unit): void
  {
      $this->unit = $unit;
  }

  public function getBrand(): string
  {
      return $this->brand;
  }

  public function setBrand(string $brand): void
  {
      $this->brand = $brand;
  }

  public function getObservation(): string
  {
      return $this->observation;
  }

  public function setObservation(string $observation): void
  {
      $this->observation = $observation;
  }

  public function getProductType(): \App\Core\ProductType
  {
      return $this->productType;
  }

  public function setProductType(\App\Core\ProductType $productType): void
  {
      $this->productType = $productType;
  }
}