<?php declare(strict_types = 1);


namespace Vb\OrderContext\Domain;

use Throwable;

class ProductPriceNotFoundException extends NotFoundException
{
	public function __construct(EAN $productEan, Throwable $previous = null)
	{
		parent::__construct("Price for product with ean {$productEan->getValue()} not found.", $previous);
	}
}
