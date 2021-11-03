<?php


namespace JuanjoMB\Memerize\Tests\Integration;

use JuanjoMB\Memerize\Builder\MemeBuilder;
use JuanjoMB\Memerize\Model\File;
use JuanjoMB\Memerize\Transformers\TextTransformer;
use PHPUnit\Framework\TestCase;
use thiagoalessio\TesseractOCR\TesseractOCR;

/**
 * @author Juanjo Martínez <jmartinez@wearemarketing.com>
 */
class TextTransformerTest extends TestCase
{

	public function testCreate()
	{
		$builder = new MemeBuilder();

		$options = [
			'text' => 'Your test passes',
			'font' => __DIR__.'/../Resources/fonts/impact.ttf',
			'font_size' => 175,
			'color' => 'White',
			'x' => 10,
			'y' => 500,
			'angle' => 0,
		];

		$transformer = new TextTransformer($options);

		$file = $builder->setFilePath(__DIR__.'/../Resources/img/test.jpg')->addTransformer($transformer)->build();

		file_put_contents(__DIR__.'/../Resources/img/test_output.jpg', $file->getContent());

		$this->assertFileExists(__DIR__.'/../Resources/img/test_output.jpg');

		$this->assertImageContainsText(__DIR__.'/../Resources/img/test_output.jpg', 'Your test passes');

	}

	private function assertImageContainsText(string $filePath, string $expectedText)
	{
		$image = new \Imagick($filePath);

		$image->setImageType(\Imagick::IMGTYPE_GRAYSCALE);
		$image->brightnessContrastImage(-90, 75);

		$imageText = (new TesseractOCR())->imageData($image->getImageBlob(), $image->getImageLength())->run();

		$this->assertStringContainsString($expectedText, $imageText);
	}

}
