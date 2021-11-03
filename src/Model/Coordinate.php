<?php


namespace JuanjoMB\Memerize\Model;

/**
 * @author Juanjo Martínez <jmartinez@wearemarketing.com>
 */
final class Coordinate
{
	private float $x;

	private float $y;

	/**
	 * Coordinate constructor.
	 * @param float $x
	 * @param float $y
	 */
	public function __construct(float $x, float $y)
	{
		$this->x = $x;
		$this->y = $y;
	}

	/**
	 * @return float
	 */
	public function getX(): float
	{
		return $this->x;
	}


	/**
	 * @return float
	 */
	public function getY(): float
	{
		return $this->y;
	}

}
