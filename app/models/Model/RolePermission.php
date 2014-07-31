<?php

namespace Model;

/**
 * Model\RolePermission
 *
 * @property integer $id
 * @property integer $role_id
 * @property integer $permission_id
 */
class RolePermission extends \Eloquent {

	protected $table = 'role_permissions';
	public $timestamps = false;
	protected $softDelete = false;

}