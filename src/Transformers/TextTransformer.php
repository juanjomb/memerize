<?php


namespace JuanjoMB\Memerize\Transformers;

use JuanjoMB\Memerize\Model\Interfaces\FileInterface;
use JuanjoMB\Memerize\Transformers\Interfaces\TransformerInterface;
use JuanjoMB\Memerize\Transformers\Interfaces\TransformerOptionsInterface;

/**
 * @author Juanjo Martínez <jmartinez@wearemarketing.com>
 */
class TextTransformer implements TransformerInterface
{
	private TextTransformerOptions $options;

	/**
	 * TextTransformer constructor.
	 * @param TextTransformerOptions $options
	 */
	public function __construct(array $options)
	{
		$this->options = TextTransformerOptions::createFromArray($options);
	}

	public function transform(FileInterface $file): void
	{
		$image = new \Imagick();
		$image->readImageBlob($file->getContent());

		$drawSettings = new \ImagickDraw();
		$drawSettings->setFillColor(new \ImagickPixel($this->options->getColor()));
		$drawSettings->setFont($this->options->getText()->getFont());
		$drawSettings->setFontSize($this->options->getFontSize());
		$drawSettings->setStrokeColor('#000');
		$drawSettings->setStrokeWidth(4);
		$drawSettings->setGravity($this->options->getGravity());

		$image->annotateImage(
			$drawSettings,
			$this->options->getCoordinate() ? $this->options->getCoordinate()->getX() : 0,
			$this->options->getCoordinate() ? $this->options->getCoordinate()->getY() : 0,
			0,
			$this->options->getText()->getContent()
		);

		$file->setContent($image->getImageBlob());

		$image->destroy();
	}
}
