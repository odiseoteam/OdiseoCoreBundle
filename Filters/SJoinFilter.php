<?php

namespace Odiseo\Bundle\CoreBundle\Filters;

use Doctrine\ORM\Query\Expr;

/**
 * SortFilter
 */
class SortFilter extends Filter
{
	/**
     * @var integer
     */
	private $inValues;
    
    public function setup($options)
    {
    	$this->order = $options;
    }
    
    public function getExpression()
    {
    	if( $this->order == 'asc')
   	    	return $this->expr->asc( $this->entityAlias .'.'. $this->entityProperty );
    	else
    		return $this->expr->desc( $this->entityAlias .'.'. $this->entityProperty );
    }
}
