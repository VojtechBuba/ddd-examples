<?php declare(strict_types = 1);

namespace Vb\OrderContext\Domain;

interface BasketsRepository
{

	/**
	 * @throws BasketNotFoundException
	 */
	public function get(Hash $hash): Basket;

	public function add(Basket $basket): void;

	public function remove(Basket $basket): void;
}
