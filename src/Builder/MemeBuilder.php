<?php


namespace JuanjoMB\Memerize\Builder;

use JuanjoMB\Memerize\Builder\Interfaces\MemeBuilderInterface;
use JuanjoMB\Memerize\Model\File;
use JuanjoMB\Memerize\Model\Interfaces\FileInterface;
use JuanjoMB\Memerize\Transformers\Interfaces\TransformerInterface;

/**
 * @author Juanjo Martínez <jmartinez@wearemarketing.com>
 */
class MemeBuilder implements MemeBuilderInterface
{
	private string $filePath;

	private array $transformers;

	public function build(): FileInterface
	{
		$file = new File(file_get_contents($this->filePath));

		foreach ($this->transformers as $transformer) {
			$transformer->transform($file);
		}

		return $file;
	}

	public function setFilePath(string $filePath): self
	{
		$this->filePath = $filePath;

		return $this;
	}

	public function addTransformer(TransformerInterface $transformer): self
	{
		$this->transformers[] = $transformer;

		return $this;
	}

}
