<?php


namespace JuanjoMB\Memerize\Model;


use Assert\Assert;
use Assert\AssertionFailedException;

/**
 * @author Juanjo Martínez <jmartinez@wearemarketing.com>
 */
final class Text
{
	private string $content;

	private Font $font;

	/**
	 * Text constructor.
	 * @param string $content
	 * @param Font $font
	 * @param int $maxWidth
	 */
	public function __construct(string $content, Font $font)
	{
		$this->content = $content;
		$this->font = $font;
	}

	/**
	 * @return string
	 */
	public function getContent(): string
	{
		return $this->content;
	}

	/**
	 * @return Font
	 */
	public function getFont(): Font
	{
		return $this->font;
	}

}
