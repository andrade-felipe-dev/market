<?php 
namespace App\Core;


class ProductType 
{
  private string $name;

  private string $descrption;

  private string $category;

  private int $tax;

    public function __construct(string $name, string $descrption, string $category, int $tax)
    {
        $this->name = $name;
        $this->descrption = $descrption;
        $this->category = $category;
        $this->tax = $tax;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescrption(): string
    {
        return $this->descrption;
    }

    public function setDescrption(string $descrption): void
    {
        $this->descrption = $descrption;
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