<?php declare(strict_types = 1);


namespace Vb\OrderContext\Domain;

use Throwable;

class BasketNotFoundException extends NotFoundException
{
	public function __construct(Hash $hash, Throwable $previous = null)
	{
		parent::__construct("Basket with hash {$hash->getValue()} not found.", $previous);
	}
}
