<?php declare(strict_types = 1);

namespace Vb\OrderContext\Domain;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Vb\OrderContext\Domain\Price\Currency;
use Vb\OrderContext\Domain\Price\Price;
use Vb\OrderContext\Domain\Price\Value;

class Basket
{

	private Hash $hash;

	/**
	 * @var Collection<string, Product>
	 */
	private Collection $products;

	private Value $totalPriceWithVat;

	private Value $totalPriceWithoutVat;

	private Currency $currency;

	private ?CustomerId $customerId;


	public function __construct(
		Hash     $hash,
		Currency $currency,
		?CustomerId $customerId
	)
	{
		$this->hash = $hash;
		$this->currency = $currency;
		$this->totalPriceWithVat = new Value("0");
		$this->products = new ArrayCollection();
		$this->customerId = $customerId;
	}


	public function addProduct(Quantity $quantity, Price $unitPrice, string $name, EAN $ean): ProductDetail
	{
		if ( ! $unitPrice->getCurrency()->equals($this->currency)) {
			throw new CurrencyMismatchException($this->currency);
		}

		$product = new Product(
			ProductId::create(),
			$name,
			$quantity,
			$unitPrice,
			$ean
		);

		$this->products->set($product->getProductId()->getValue(), $product);
		$this->totalPriceWithVat = $this->totalPriceWithVat->plus($product->getTotalPrice()->getWithVat());
		$this->totalPriceWithoutVat = $this->totalPriceWithoutVat->plus($product->getTotalPrice()->getExcVat());

		return $product->getDetail();
	}


	public function changeProductQuantity(ProductId $productId, Quantity $quantity): ProductDetail
	{
		$product = $this->getProduct($productId);

		$totalPriceBefore = $product->getTotalPrice();
		$changed = $product->changeQuantity($quantity);

		$priceDifferenceWithVat = $totalPriceBefore->getWithVat()->minus($changed->getTotalPrice()->getWithVat());
		$priceDifferenceWithoutVat = $totalPriceBefore->getExcVat()->minus($changed->getTotalPrice()->getExcVat());

		$this->totalPriceWithVat = $this->totalPriceWithVat->plus($priceDifferenceWithVat);
		$this->totalPriceWithoutVat = $this->totalPriceWithoutVat->plus($priceDifferenceWithoutVat);

		return $changed;
	}


	public function removeProduct(ProductId $productId): BasketDetail
	{
		$product = $this->getProduct($productId);

		$this->products->remove($productId->getValue());

		$this->totalPriceWithVat = $this->totalPriceWithVat->minus($product->getTotalPrice()->getWithVat());
		$this->totalPriceWithoutVat = $this->totalPriceWithoutVat->minus($product->getTotalPrice()->getExcVat());

		return $this->getDetail();
	}


	public function getHash(): Hash
	{
		return $this->hash;
	}


	public function getTotalPriceWithVat(): Value
	{
		return $this->totalPriceWithVat;
	}


	public function getTotalPriceWithoutVat(): Value
	{
		return $this->totalPriceWithoutVat;
	}


	public function getCurrency(): Currency
	{
		return $this->currency;
	}


	public function getCustomerId(): ?CustomerId
	{
		return $this->customerId;
	}


	/**
	 * @throws ProductNotFoundException
	 */
	private function getProduct(ProductId $productId): Product
	{
		$product = $this->products->get($productId->getValue());

		if ( ! $product instanceof Product) {
			throw new ProductNotFoundException($productId);
		}

		return $product;
	}


	public function getDetail(): BasketDetail
	{
		return new BasketDetail(
			$this->hash,
			$this->totalPriceWithVat,
			$this->totalPriceWithoutVat,
			$this->currency
		);
	}
}
