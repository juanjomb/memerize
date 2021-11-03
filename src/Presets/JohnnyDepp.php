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
class JohnnyDepp
{
	const FILEPATH = __DIR__.'/../Resources/images/depp.jpg';

	const FONTPATH = __DIR__.'/../Resources/fonts/impact.ttf';

	const TEXT_POSITION = [
		0 => 350,
		1 => 850,
		2 => 1300,
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

		foreach ($this->texts as $key => $text){
			$transformer = new TextTransformer([
				'text' => $text,
				'font_size' => $this->fontSizeGuesser->guess($text, getimagesize(self::FILEPATH)[0], 125),
				'coordinate' => new Coordinate(0, static::TEXT_POSITION[$key]),
				'color' => new Color('#FFFFFF'),
				'gravity' => \Imagick::GRAVITY_NORTH
			]);

			$this->builder->addTransformer($transformer);
		}

		return $this->builder->build();
	}
}
