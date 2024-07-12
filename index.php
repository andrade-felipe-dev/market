<?php 

require __DIR__ . '/vendor/autoload.php';


$productType = new \App\Core\ProductType(
  name: 'tipo',
  descrption: 'tipo de descrição',
  category: "teste a",
  tax: 10
);

$productType2 = new \App\Core\ProductType(
  name: 'tipo2',
  descrption: 'tipo 2',
  category: 'b',
  tax: 5
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

$product2 = new \App\Core\Product(
  name: "teste",
  description: "descrição teste",
  priceInCents: 100,
  unit: "UN",
  brand: "Marca",
  observation: "",
  productType: $productType2
);

$itemSale = new \App\Core\ItemProduct\ItemProduct(
  quantity: 1,
  product: $product
);

$itemSale2 = new \App\Core\ItemProduct\ItemProduct(
  quantity: 2,
  product: $product2
);

$sale = new \App\Core\Sale\Sale();
$sale->addItemProduct(
  itemProduct: $itemSale
);
$sale->addItemProduct(
  itemProduct: $itemSale2
);
