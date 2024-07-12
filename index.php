<?php 

require __DIR__ . '/vendor/autoload.php';


$productType = new \App\Core\ProductType(
  name: 'tipo',
  descrption: 'tipo de descrição',
  category: "teste a",
  tax: 10
);

$product = new \App\Core\Product(
    name: "teste",
    description: "descrição teste",
    priceInCents: 100,
    unit: "UN",
    brand: "Marca",
    observation: "",
    productType: $productType
);

echo $product->getName();
echo $productType->getTax();