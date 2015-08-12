<?php

namespace Odiseo\Bundle\CoreBundle\Services;

abstract class BaseDbService implements BaseDbServiceInterface
{
	protected $em;
	protected $mainRepositoryName;

	protected function __construct($em)
	{
		$this->em = $em;
	}

	public function save($entity)
	{
		$this->em->persist($entity);
		$this->em->flush($entity);
	}
	
	public function update($entity)
	{
		$this->em->persist($entity);
		$this->em->flush($entity);
	}
	
	public function saveOrUpdate($entity)
	{
		$this->em->persist($entity);
		$this->em->flush($entity);
	}
	
	public function remove($entity)
	{
		$this->em->remove($entity);
		$this->em->flush();
	}

	public function findOneById($id)
    {
		return $this->getMainRepository()->findOneById($id);
	}
	
	public function findByKeysValues($array)
    {
		return $this->getMainRepository()->findBy($array);
	}
	
	public function findByKeyValue($key, $value)
    {
		return $this->getMainRepository()->findBy(array($key => $value));
	}
	
	public function  findOneByKeyValue($key, $value)
    {
		return $this->getMainRepository()->findOneBy( array($key => $value));
	}
	
	public function  findOneByKeysValues($array)
    {
		return $this->getMainRepository()->findOneBy( $array);
	}
	
	public function findAll()
    {
		return $this->getMainRepository()->findAll();
	}
	
	protected abstract function getMainRepository();
}