<?php

namespace Odiseo\Bundle\CoreBundle\Filters;

use Doctrine\ORM\Query\Expr;

/**
 * State 
 */
class RangeFilter extends Filter
{
	/**
     * @var integer
     */
	private $minValue;
    private $maxValue;
    
    public function setup($options)
    {
    	$this->minValue = $options[0];
    	$this->maxValue = $options[1];
    }
    
    public function getExpression()
    {
    	return $this->expr->between($this->entityAlias . '.' . $this->entityProperty , $this->minValue,   $this->maxValue);
    }
}