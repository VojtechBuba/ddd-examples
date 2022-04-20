<?php declare(strict_types = 1);


namespace Vb\OrderContext\Domain;

use Vb\OrderContext\Domain\Price\Price;

interface PriceListService
{

	/**
	 * @throws ProductPriceNotFoundException
	 */
	public function getProductPrice(EAN $productEan): Price;
}
