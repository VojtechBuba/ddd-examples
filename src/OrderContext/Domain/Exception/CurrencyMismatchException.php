<?php declare(strict_types = 1);


namespace Vb\OrderContext\Domain;

use Throwable;
use Vb\OrderContext\Domain\Price\Currency;

class CurrencyMismatchException extends DomainException
{
	public function __construct(Currency $currency, Throwable $previous = null)
	{
		parent::__construct("Cannot have multiple currency in one basket. Basket is in {$currency->getCode()} currency.", $previous);
	}
}
