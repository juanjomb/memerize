<?php


namespace JuanjoMB\Memerize\Model;

use JuanjoMB\Memerize\Model\Interfaces\FileInterface;

/**
 * @author Juanjo Martínez <jmartinez@wearemarketing.com>
 */
class File implements FileInterface
{
	private string $content;

	/**
	 * File constructor.
	 * @param string $content
	 */
	public function __construct(string $content)
	{
		$this->content = $content;
	}


	public function getContent(): string
	{
		return $this->content;
	}

	/**
	 * @param string $content
	 * @return File
	 */
	public function setContent(string $content)
	{
		$this->content = $content;
		return $this;
	}
}
