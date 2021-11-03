<?php


namespace JuanjoMB\Memerize\Presets;

use Assert\Assert;
use JuanjoMB\Memerize\Builder\Interfaces\MemeBuilderInterface;
use JuanjoMB\Memerize\Guesser\Interfaces\FontSizeGuesserInterface;
use JuanjoMB\Memerize\Model\Color;
use JuanjoMB\Memerize\Model\Coordinate;
use JuanjoMB\Memerize\Model\Font;
use JuanjoMB\Memerize\Model\Text;
use JuanjoMB\Memerize\Transformers\TextTransformer;

/**
 * @author Juanjo Martínez <jmartinez@wearemarketing.com>
 */
class DistractedBoyfriend
{
	const FILEPATH = __DIR__.'/../Resources/images/distracted_boyfriend.jpg';

	const FONTPATH = __DIR__.'/../Resources/fonts/impact.ttf';

	const TEXT_POSITION = [
		'x' => [
			0 => 450,
			1 => 1250,
			2 => 1900,
		],
		'y' => [
			0 => 1500,
			1 => 1500,
			2 => 1500,
		]
	];

	const MAX_WIDTHS = [
		0 => 600,
		1 => 600,
		2 => 400,
	];

	private array $texts;

	private MemeBuilderInterface $builder;

	private FontSizeGuesserInterface $fontSizeGuesser;

	/**
	 * DistractedBoyfriend constructor.
	 * @param array $texts
	 * @param MemeBuilderInterface $builder
	 * @param FontSizeGuesserInterface $fontSizeGuesser
	 */
	public function __construct(array $texts, MemeBuilderInterface $builder, FontSizeGuesserInterface $fontSizeGuesser)
	{
		Assert::that($texts)->count(3);
		Assert::that($texts)->keyExists(0);
		Assert::that($texts)->keyExists(1);
		Assert::that($texts)->keyExists(2);

		foreach ($texts as $text){
			$this->texts[] = new Text($text, Font::fromString(self::FONTPATH));
		}

		$this->builder = $builder;
		$this->fontSizeGuesser = $fontSizeGuesser;
	}

	public function __invoke()
	{
		$this->builder->setFilePath(static::FILEPATH);

		foreach ($this->texts as $key => $text ){
			$transformer = new TextTransformer([
				'text' => $text,
				'font_size' => $this->fontSizeGuesser->guess($text, self::MAX_WIDTHS[$key], 500),
				'color' => new Color('#FFFFFF'),
				'coordinate' => new Coordinate(static::TEXT_POSITION['x'][$key], static::TEXT_POSITION['y'][$key]),
			]);

			$this->builder->addTransformer($transformer);
		}

		return $this->builder->build();
	}
}
