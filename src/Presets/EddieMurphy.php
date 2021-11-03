<?php


namespace JuanjoMB\Memerize\Presets;

use Assert\Assert;
use JuanjoMB\Memerize\Builder\Interfaces\MemeBuilderInterface;
use JuanjoMB\Memerize\Guesser\Interfaces\FontSizeGuesserInterface;
use JuanjoMB\Memerize\Model\Color;
use JuanjoMB\Memerize\Model\Font;
use JuanjoMB\Memerize\Model\Text;
use JuanjoMB\Memerize\Transformers\TextTransformer;

/**
 * @author Juanjo Martínez <jmartinez@wearemarketing.com>
 */
class EddieMurphy
{
	const FILEPATH = __DIR__.'/../Resources/images/eddie_murphy.jpg';

	const FONTPATH = __DIR__.'/../Resources/fonts/impact.ttf';

	const GRAVITIES = [
		0 => \Imagick::GRAVITY_NORTH,
		1 => \Imagick::GRAVITY_SOUTH,
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
		Assert::that($texts)->minCount(1);
		Assert::that($texts)->maxCount(2);
		Assert::that($texts)->keyExists(0);

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
				'font_size' => $this->fontSizeGuesser->guess($text, getimagesize(self::FILEPATH)[0], 300),
				'color' => new Color('#FFFFFF'),
				'gravity' => self::GRAVITIES[$key]
			]);

			$this->builder->addTransformer($transformer);
		}

		return $this->builder->build();
	}
}
