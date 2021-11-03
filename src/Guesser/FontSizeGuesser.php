<?php


namespace JuanjoMB\Memerize\Guesser;

use JuanjoMB\Memerize\Guesser\Interfaces\FontSizeGuesserInterface;
use JuanjoMB\Memerize\Model\Font;
use JuanjoMB\Memerize\Model\Text;

/**
 * @author Juanjo Martínez <jmartinez@wearemarketing.com>
 */
class FontSizeGuesser implements FontSizeGuesserInterface
{
	public function guess(Text $text, int $maxWidth, int $maxSize): int
	{
		$image = new \Imagick();

		$i = $maxSize;
		$draw = new \ImagickDraw();
		$draw->setFont($text->getFont());
		while ($i > 0){
			$draw->setFontSize($i);

			$fontMetrics = $image->queryFontMetrics($draw, $text->getContent());
			if($fontMetrics['textWidth'] <= $maxWidth){
				break;
			}
			$i--;

		}

		return $i;
	}


}
