<?php


namespace JuanjoMB\Memerize\Builder\Interfaces;

use JuanjoMB\Memerize\Model\Interfaces\FileInterface;
use JuanjoMB\Memerize\Transformers\Interfaces\TransformerInterface;

/**
 * @author Juanjo Martínez <jmartinez@wearemarketing.com>
 */
interface MemeBuilderInterface
{
	public function build(): FileInterface;

	public function addTransformer(TransformerInterface $transformer): self;

	public function setFilePath(string $filePath): self;
}
