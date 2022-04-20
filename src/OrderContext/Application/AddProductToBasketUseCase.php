<?php declare(strict_types = 1);


namespace Vb\OrderContext\Application;

use Vb\OrderContext\Domain\BasketNotFoundException;
use Vb\OrderContext\Domain\BasketsRepository;
use Vb\OrderContext\Domain\EAN;
use Vb\OrderContext\Domain\Hash;
use Vb\OrderContext\Domain\MinimumQuantityException;
use Vb\OrderContext\Domain\PriceListService;
use Vb\OrderContext\Domain\ProductDetail;
use Vb\OrderContext\Domain\ProductPriceNotFoundException;
use Vb\OrderContext\Domain\Quantity;

class AddProductToBasketUseCase
{

	private BasketsRepository $basketsRepository;

	private PriceListService $priceListService;


	public function __construct(
		BasketsRepository $basketsRepository,
		PriceListService $priceListService
	)
	{
		$this->basketsRepository = $basketsRepository;
		$this->priceListService = $priceListService;
	}


	/**
	 * @throws BasketNotFoundException
	 * @throws MinimumQuantityException
	 * @throws ProductPriceNotFoundException
	 */
	public function execute(string $hash, string $name, int $quantity, int $ean): ProductDetail
	{
		$hash = new Hash($hash);
		$ean = new EAN($ean);
		$quantity = new Quantity($quantity);

		$basket = $this->basketsRepository->get($hash);
		$price = $this->priceListService->getProductPrice($ean);

		return $basket->addProduct($quantity, $price, $name, $ean);
	}
}
