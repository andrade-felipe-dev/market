<?php 
namespace App\Core;


class ProductType 
{
  private int $id;

  private string $name;

  private string $description;

  private string $category;

  private int $tax;

  public function __construct(string $name, string $description, string $category, int $tax, $id = 0)
  {
      $this->id = $id;
      $this->name = $name;
      $this->description = $description;
      $this->category = $category;
      $this->tax = $tax;
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

  public function getCategory(): string
  {
      return $this->category;
  }

  public function setCategory(string $category): void
  {
      $this->category = $category;
  }

  public function getTax(): int
  {
      return $this->tax;
  }

  public function setTax(int $tax): void
  {
      $this->tax = $tax;
  }
}