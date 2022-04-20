<?php declare(strict_types = 1);


namespace Vb\OrderContext\Domain;

use Throwable;

class ProductNotFoundException extends NotFoundException
{
	public function __construct(ProductId $productId, Throwable $previous = null)
	{
		parent::__construct("Product with id {$productId->getValue()} not found.", $previous);
	}
}
