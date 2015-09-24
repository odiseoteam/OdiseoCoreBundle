<?php

namespace Odiseo\Bundle\CoreBundle\Filters;

use Doctrine\ORM\Query\Expr;

/**
 * State
 */
class  WhereQueryBuilder
{
	public  static function getQuery($qb, $entityAlias, $filters , $sortFilters)
	{
		$withFilters = is_array($filters) && count($filters) > 0;
		$qb
			->leftjoin($entityAlias.'.'."taxons", 't')
        	->leftjoin($entityAlias.'.'."variants", 'variant')
			->leftjoin($entityAlias.'.'."ranking", 'ranking')
		;	
		
		if($withFilters)
		{
            $qb->where($filters[0]->getExpression());
		
			for ($i = 1; $i < count($filters); $i++)
			{
				$qb->andWhere($filters[$i]->getExpression());
			}
		}
		
		for( $i = 0 ; $i < count($sortFilters) ; $i++)
        {
			$qb->addOrderBy($sortFilters[$i]->getExpression());
		}

		return $qb->getQuery();
	}   
}