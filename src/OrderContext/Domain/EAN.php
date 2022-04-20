<?php declare(strict_types = 1);


namespace Vb\OrderContext\Domain;

class EAN
{

	private int $value;


	public function __construct(
		int $value
	)
	{
		$this->value = $value;
	}


	public function getValue(): int
	{
		return $this->value;
	}


	public function equals(self $to): bool
	{
		return $this->getValue() === $to->getValue();
	}
}
