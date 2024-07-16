<?php 
namespace App\Core;


class ProductType 
{
  private int $id;

  private string $name;

  private string $description;

  private int $tax;

  public function __construct(string $name, string $description, int $tax, $id = 0)
  {
      $this->id = $id;
      $this->name = $name;
      $this->description = $description;
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

  public function getTax(): int
  {
      return $this->tax;
  }

  public function setTax(int $tax): void
  {
      $this->tax = $tax;
  }

  public function getAttributes(): array
  {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'description' => $this->description,
      'tax' => $this->tax,
    ];
  }
}