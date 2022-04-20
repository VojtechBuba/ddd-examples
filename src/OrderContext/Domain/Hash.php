<?php declare(strict_types = 1);

namespace Vb\OrderContext\Domain;

class Hash
{

	private string $value;

	public function __construct(
		string $value
	)
	{
		$this->value = $value;
	}


	public function getValue(): string
	{
		return $this->value;
	}


	public function equals(self $to): bool
	{
		return $this->getValue() === $to->getValue();
	}
}
