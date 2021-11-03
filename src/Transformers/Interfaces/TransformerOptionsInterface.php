<?php

namespace JuanjoMB\Memerize\Transformers\Interfaces;

use JuanjoMB\Memerize\Model\Interfaces\FileInterface;

/**
 * @author Juanjo Martínez <jmartinez@wearemarketing.com>
 */
interface TransformerOptionsInterface
{
	public static function createFromArray(array $options): self;
}
