<?php declare(strict_types = 1);


namespace Vb\OrderContext\Domain\Price;

use Vb\OrderContext\Domain\Quantity;

class Price
{

	private Value $priceWithoutVat;

	private Value $priceWithVat;

	private VatRate $vatRate;

	private Currency $currency;


	public function __construct(
		Value    $priceWithoutVat,
		VatRate    $vatRate,
		Currency $currency
	)
	{
		$this->priceWithoutVat = $priceWithoutVat;
		$this->vatRate = $vatRate;
		$this->currency = $currency;
		$this->priceWithVat = $priceWithoutVat->plus(
			$priceWithoutVat->multiply($vatRate->getValue()->divide(new Value('100')))
		);
	}


	public function multiply(Quantity $quantity): self
	{
		return new self(
			$this->priceWithoutVat->multiply(
				new Value((string) $quantity->getAmount())
			),
			$this->vatRate,
			$this->currency
		);
	}


	public function getExcVat(): Value
	{
		return $this->priceWithoutVat;
	}


	public function getWithVat(): Value
	{
		return $this->priceWithVat;
	}


	public function getVat(): Value
	{
		return $this->priceWithVat->minus($this->priceWithoutVat);
	}


	public function getVatRate(): VatRate
	{
		return $this->vatRate;
	}


	public function getCurrency(): Currency
	{
		return $this->currency;
	}
}
