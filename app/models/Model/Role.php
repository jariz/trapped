<?php

namespace Model;

/**
 * Model\Role
 *
 * @property integer $id
 * @property string $name
 */
class Role extends \Eloquent {

	protected $table = 'roles';
	public $timestamps = false;
	protected $softDelete = false;

}