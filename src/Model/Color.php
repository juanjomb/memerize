<?php


namespace JuanjoMB\Memerize\Model;


use Assert\Assert;
use Assert\AssertionFailedException;

/**
 * @author Juanjo Martínez <jmartinez@wearemarketing.com>
 */
final class Color
{
	private string $code;

	/**
	 * Color constructor.
	 * @param string $code
	 */
	public function __construct(string $code)
	{
		Assert::that($code)->regex('/^#(?:[0-9a-fA-F]{3}){1,2}$/');
		$this->code = $code;
	}

	/**
	 * @return string
	 */
	public function getCode(): string
	{
		return $this->code;
	}

	public function __toString()
	{
		return $this->code;
	}
}
