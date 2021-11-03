<?php


namespace JuanjoMB\Memerize\Transformers;

use Assert\Assert;
use JuanjoMB\Memerize\Model\Color;
use JuanjoMB\Memerize\Model\Coordinate;
use JuanjoMB\Memerize\Model\Font;
use JuanjoMB\Memerize\Model\Text;
use JuanjoMB\Memerize\Transformers\Interfaces\TransformerOptionsInterface;

/**
 * @author Juanjo Martínez <jmartinez@wearemarketing.com>
 */
class TextTransformerOptions implements TransformerOptionsInterface
{
	private Text $text;

	private float $fontSize;

	private Color $color;

	private ?Coordinate $coordinate;

	private ?int $gravity;

	/**
	 * TextTransformerOptions constructor.
	 * @param string $text
	 * @param Font $font
	 * @param float $fontSize
	 * @param string $color
	 * @param Coordinate|null $coordinate
	 * @param int|null $gravity
	 */
	public function __construct(Text $text, float $fontSize, Color $color, ?Coordinate $coordinate, ?int $gravity)
	{
		$this->text = $text;
		$this->fontSize = $fontSize;
		$this->color = $color;
		$this->coordinate = $coordinate;
		$this->gravity = $gravity;
	}


	public static function createFromArray(array $options): self
	{
		Assert::that($options)->keyExists('font_size');
		Assert::that($options)->keyExists('color');
		Assert::that($options)->keyExists('text');

		return new static(
			$options['text'],
			$options['font_size'],
			$options['color'],
			$options['coordinate'] ?? null,
			$options['gravity'] ?? null,
		);
	}

	/**
	 * @return Text
	 */
	public function getText(): Text
	{
		return $this->text;
	}

	/**
	 * @return float
	 */
	public function getFontSize(): float
	{
		return $this->fontSize;
	}

	public function getColor(): Color
	{
		return $this->color;
	}

	/**
	 * @return Coordinate|null
	 */
	public function getCoordinate(): ?Coordinate
	{
		return $this->coordinate;
	}

	/**
	 * @return int|null
	 */
	public function getGravity(): ?int
	{
		return $this->gravity;
	}
}
