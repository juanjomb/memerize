<?php

namespace JuanjoMB\Memerize\Transformers\Interfaces;

use JuanjoMB\Memerize\Model\Interfaces\FileInterface;

/**
 * @author Juanjo Martínez <jmartinez@wearemarketing.com>
 */
interface TransformerInterface
{
	public function transform(FileInterface $file): void;
}
