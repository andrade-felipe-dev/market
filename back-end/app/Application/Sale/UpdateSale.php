<?php

namespace App\Application\Sale;

class UpdateSale
{
  private SaleRepositoryInterface $saleRepository;

  public function __construct(SaleRepositoryInterface $saleRepository)
  {
    $this->saleRepository = $saleRepository;
  }

  public function execute(SaleInputDTO $dto): bool
  {
    return $this->saleRepository->update($dto);
  }
}