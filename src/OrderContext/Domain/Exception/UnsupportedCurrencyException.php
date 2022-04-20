<?php declare(strict_types = 1);


namespace Vb\OrderContext\Domain;

use Throwable;

class UnsupportedCurrencyException extends DomainException
{
	public function __construct(string $code, Throwable $previous = null)
	{
		parent::__construct("Unsupported currency {$code}", $previous);
	}
}
