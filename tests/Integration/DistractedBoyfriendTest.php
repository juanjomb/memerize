<?php


namespace JuanjoMB\Memerize\Tests\Integration;

use JuanjoMB\Memerize\Builder\MemeBuilder;
use JuanjoMB\Memerize\Guesser\FontSizeGuesser;
use JuanjoMB\Memerize\Model\File;
use JuanjoMB\Memerize\Presets\DistractedBoyfriend;
use JuanjoMB\Memerize\Transformers\TextTransformer;
use PHPUnit\Framework\TestCase;
use thiagoalessio\TesseractOCR\TesseractOCR;

/**
 * @author Juanjo Martínez <jmartinez@wearemarketing.com>
 */
class DistractedBoyfriendTest extends TestCase
{

	public function testCreate()
	{
		$builder = new MemeBuilder();
		$guesser  = new FontSizeGuesser();
		$meme = new DistractedBoyfriend(['Vinito', 'Filippo', 'Truxy'], $builder, $guesser);

		$file = $meme();

		file_put_contents(__DIR__.'/../Resources/img/test_output.jpg', $file->getContent());

		$this->assertFileExists(__DIR__.'/../Resources/img/test_output.jpg');

		$this->assertImageContainsText(__DIR__.'/../Resources/img/test_output.jpg', 'Vinito');

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
