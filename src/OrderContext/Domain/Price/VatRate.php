<?php declare(strict_types = 1);

namespace Vb\OrderContext\Domain\Price;

use Brick\Math\BigDecimal;
use Vb\OrderContext\Domain\Exception\InvalidVatRateValueException;

class VatRate
{

	private Value $value;

	public function __construct(
		string $rate
	)
	{
		$rateValue = BigDecimal::of($rate);

		if( ! $rateValue->isPositiveOrZero()) {
			throw new InvalidVatRateValueException($rate);
		}

		if ( ! $rateValue->isLessThanOrEqualTo(100)) {
			throw new InvalidVatRateValueException($rate);
		}

		$this->value = new Value($rate);
	}


	public function getValue(): Value
	{
		return $this->value;
	}
}
