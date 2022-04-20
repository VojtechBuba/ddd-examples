<?php declare(strict_types = 1);

namespace Vb\OrderContext\Domain\Price;

use Vb\OrderContext\Domain\UnsupportedCurrencyException;
use function in_array;

class Currency
{

	private const SUPPORTED_CODES = [
		'CZK',
		'EUR',
	];

	private string $code;


	public function __construct(
		string $code
	)
	{
		if ( ! in_array($code, self::SUPPORTED_CODES)) {
			throw new UnsupportedCurrencyException($code);
		}

		$this->code = $code;
	}


	public function getCode(): string
	{
		return $this->code;
	}


	public function equals(self $to): bool
	{
		return $this->getCode() === $to->getCode();
	}
}
