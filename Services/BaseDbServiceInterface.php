<?php

namespace Odiseo\Bundle\CoreBundle\Services;

interface BaseDbServiceInterface
{
	public function save($entity);
	public function update($entity);
	public function saveOrUpdate($entity);
	public function remove($entity);
	public function findOneById($id);
	public function findByKeysValues($array);
	public function findByKeyValue($key, $value);
	public function findOneByKeyValue($key, $value);
	public function findOneByKeysValues($array);
	public function findAll();
}