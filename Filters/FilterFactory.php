<?php

namespace Odiseo\Bundle\CoreBundle\Filters;

use Doctrine\ORM\Query\Expr;

/**
 * FilterFactory factory de filtros para consultas.
 * 
 */
 
class  FilterFactory
{
	const  OR_FILTER_TYPE = 1;
	const  RANGE_FILTER_TYPE = 2;
	const  SORT_FILTER_TYPE = 3;
	
	/**
	 * 
	 * 
	 * @param FilterTypes $FILTER_TYPE
	 * @param array  $args  array que contiene los argumentos para pasar al filtro 
	 * 	 por ejemplo para RangeFilter : args['entityAlias'] = 'p' , 
	 * 				  				  args['entityProperty'] = 'price' ,
	 * 								  args['filterArgs'] = array(minValue, maxValue).
	 */
	
	public static function getFilterInstance($FILTER_TYPE , $args)
	{		
		$instance = NULL;
		switch($FILTER_TYPE){
			case self::OR_FILTER_TYPE : 
				$instance =  new OrFilter( $args['entityAlias'], $args['entityProperty'], $args['filterArgs']);
			break;

			case self::RANGE_FILTER_TYPE :
				$instance =  new RangeFilter( $args['entityAlias'], $args['entityProperty'], $args['filterArgs']);
			break;
			
			case self::SORT_FILTER_TYPE :
				$instance =  new SortFilter( $args['entityAlias'], $args['entityProperty'], $args['filterArgs']);
				break;
		}
		$instance->setName($args['filterName']);
		
		return $instance;		
	}
	
}