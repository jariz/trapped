<?php

namespace Model;

/**
 * Model\Permission
 *
 * @property integer $id
 * @property string $alias
 */
class Permission extends \Eloquent {

	protected $table = 'permissions';
	public $timestamps = false;
	protected $softDelete = false;

}