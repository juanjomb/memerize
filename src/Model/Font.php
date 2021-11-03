<?php


namespace JuanjoMB\Memerize\Model;


use Assert\Assert;
use Assert\AssertionFailedException;

/**
 * @author Juanjo Martínez <jmartinez@wearemarketing.com>
 */
final class Font
{
	private string $font;

	private function __construct(string $font)
	{
		$imagick = new \Imagick();
		try {
			Assert::that($imagick->queryFonts())->contains($font);
		} catch (AssertionFailedException $e){
			Assert::that($font)->file();
		}

		$this->font = $font;

		$imagick->destroy();
	}


	public function __toString()
	{
		return $this->font;
	}

	public static function fromString(string $font)
	{
		return new self($font);
	}

}
