<?php declare(strict_types = 1);


namespace Vb\OrderContext\Domain;

use Vb\OrderContext\Domain\Price\Price;

class ProductDetail
{

	private ProductId $productId;

	private string $name;

	private Price $unitPrice;

	private Price $totalPrice;

	private Quantity $quantity;

	private EAN $ean;


	public function __construct(
		ProductId $productId,
		string $name,
		Price $unitPrice,
		Price $totalPrice,
		Quantity $quantity,
		EAN $ean
	)
	{
		$this->productId = $productId;
		$this->name = $name;
		$this->unitPrice = $unitPrice;
		$this->totalPrice = $totalPrice;
		$this->quantity = $quantity;
		$this->ean = $ean;
	}


	public function getProductId(): ProductId
	{
		return $this->productId;
	}


	public function getName(): string
	{
		return $this->name;
	}


	public function getUnitPrice(): Price
	{
		return $this->unitPrice;
	}


	public function getTotalPrice(): Price
	{
		return $this->totalPrice;
	}


	public function getQuantity(): Quantity
	{
		return $this->quantity;
	}


	public function getEan(): EAN
	{
		return $this->ean;
	}
}
