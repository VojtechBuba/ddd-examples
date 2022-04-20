<?php declare(strict_types = 1);

namespace Vb\OrderContext\Domain;

class Quantity
{

	private int $amount;
	
	public function __construct(
		int $amount
	)
	{
		if ($amount <= 0) {
			throw new MinimumQuantityException($amount);
		}

		$this->amount = $amount;
	}


	public function getAmount(): int
	{
		return $this->amount;
	}


	public function add(Quantity $quantity): self
	{
		return new self(
			$this->getAmount() + $quantity->getAmount()
		);
	}


	/**
	 * @throws MinimumQuantityException
	 */
	public function subtract(Quantity $quantity): self
	{
		return new self(
			$this->getAmount() - $quantity->getAmount()
		);
	}


	public function multiply(Quantity $by): self
	{
		return new self(
			$this->getAmount() * $by->getAmount()
		);
	}
}
