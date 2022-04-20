<?php declare(strict_types = 1);


namespace Vb\OrderContext\Domain;

use Vb\OrderContext\Domain\Price\Currency;
use Vb\OrderContext\Domain\Price\Value;

class BasketDetail
{

	private Hash $hash;

	private Value $totalPriceWithVat;

	private Value $totalPRiceWithoutVat;

	private Currency $currency;


	public function __construct(
		Hash $hash,
		Value $totalPriceWithVat,
		Value $totalPRiceWithoutVat,
		Currency $currency
	)
	{
		$this->hash = $hash;
		$this->totalPriceWithVat = $totalPriceWithVat;
		$this->totalPRiceWithoutVat = $totalPRiceWithoutVat;
		$this->currency = $currency;
	}


	public function getHash(): Hash
	{
		return $this->hash;
	}


	public function getTotalPriceWithVat(): Value
	{
		return $this->totalPriceWithVat;
	}


	public function getTotalPRiceWithoutVat(): Value
	{
		return $this->totalPRiceWithoutVat;
	}


	public function getCurrency(): Currency
	{
		return $this->currency;
	}
}
