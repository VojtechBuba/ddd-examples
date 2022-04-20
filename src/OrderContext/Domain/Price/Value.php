<?php declare(strict_types = 1);


namespace Vb\OrderContext\Domain\Price;

use Brick\Math\BigDecimal;
use Brick\Math\RoundingMode;

class Value
{

	private BigDecimal $value;


	public function __construct(
		string $value
	)
	{
		$this->value = BigDecimal::of($value);
	}


	public function getValue(): string
	{
		return $this->value->__toString();
	}


	protected function getValueInstance(): BigDecimal
	{
		return $this->value;
	}


	public function plus(Value $value): self
	{
		return new self(
			$this->value->plus($value->getValueInstance())->__toString()
		);
	}


	public function minus(Value $value): self
	{
		return new self(
			$this->value->minus($value->getValueInstance())->__toString()
		);
	}


	public function divide(Value $value): self
	{
		return new self(
			$this->value->dividedBy($value->getValueInstance(), RoundingMode::HALF_UP)->__toString()
		);
	}


	public function multiply(Value $value): self
	{
		return new self(
			$this->value->multipliedBy($value->getValueInstance())->__toString()
		);
	}
}
