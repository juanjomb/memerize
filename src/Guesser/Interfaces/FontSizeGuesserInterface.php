<?php


namespace JuanjoMB\Memerize\Guesser\Interfaces;

use JuanjoMB\Memerize\Model\Font;
use JuanjoMB\Memerize\Model\Text;

/**
 * @author Juanjo Martínez <jmartinez@wearemarketing.com>
 */
interface FontSizeGuesserInterface
{
	public function guess(Text $text, int $maxWidth, int $maxSize): int;
}
