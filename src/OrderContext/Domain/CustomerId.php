<?php declare(strict_types = 1);


namespace Vb\OrderContext\Domain;

use Ramsey\Uuid\Uuid;

class CustomerId
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


	public static function create(): self
	{
		return new self(Uuid::uuid4()->toString());
	}
}
