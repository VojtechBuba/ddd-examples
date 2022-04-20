<?php declare(strict_types = 1);

namespace Vb\OrderContext\Domain;

use Vb\OrderContext\Domain\Price\Price;

class Product
{

	private ProductId $productId;

	private string $name;

	private Quantity $quantity;

	private Price $unitPrice;

	private Price $totalPrice;

	private EAN $ean;


	public function __construct(
		ProductId $productId,
		string $name,
		Quantity $quantity,
		Price $unitPrice,
		EAN $ean
	)
	{
		$this->productId = $productId;
		$this->name = $name;
		$this->quantity = $quantity;
		$this->unitPrice = $unitPrice;
		$this->totalPrice = $this->unitPrice->multiply($quantity);
		$this->ean = $ean;
	}


	public function changeQuantity(Quantity $newQuantity): ProductDetail
	{
		$this->quantity = $newQuantity;
		$this->totalPrice = $this->unitPrice->multiply($newQuantity);

		return $this->getDetail();
	}


	public function getTotalPrice(): Price
	{
		return $this->totalPrice;
	}


	public function getProductId(): ProductId
	{
		return $this->productId;
	}


	public function getName(): string
	{
		return $this->name;
	}


	public function getQuantity(): Quantity
	{
		return $this->quantity;
	}


	public function getUnitPrice(): Price
	{
		return $this->unitPrice;
	}


	public function getEan(): EAN
	{
		return $this->ean;
	}


	public function getDetail(): ProductDetail
	{
		return new ProductDetail(
			$this->getProductId(),
			$this->getName(),
			$this->getUnitPrice(),
			$this->getTotalPrice(),
			$this->getQuantity(),
			$this->getEan()
		);
	}

}
