<?php

namespace Odiseo\Bundle\CoreBundle\Filters;

use Doctrine\ORM\Query\Expr;

/**
 * OrFilter
 */
class OrFilter extends Filter
{
	/**
     * @var integer
     */
	private $inValues;
    
    public function setup($options)
    {
    	$this->inValues = $options;
    }
    
    public function getExpression()
    {
    	return $this->expr->in( $this->entityAlias .'.'. $this->entityProperty , $this->inValues );
    }
}
