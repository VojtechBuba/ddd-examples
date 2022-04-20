<?php declare(strict_types = 1);


namespace Vb\OrderContext\Domain\Exception;

use Throwable;
use Vb\OrderContext\Domain\DomainException;

class InvalidVatRateValueException extends DomainException
{
	public function __construct(string $rate, Throwable $previous = null)
	{
		parent::__construct("Vat rate must be value from zero to 100. Rate {$rate} given.", $previous);
	}
}
