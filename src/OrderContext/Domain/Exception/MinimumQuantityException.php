<?php declare(strict_types = 1);


namespace Vb\OrderContext\Domain;

use Throwable;

class MinimumQuantityException extends DomainException
{
	public function __construct(int $amount, Throwable $previous = null)
	{
		parent::__construct("Minimum quantity is 1, amount {$amount} given.", $previous);
	}
}
