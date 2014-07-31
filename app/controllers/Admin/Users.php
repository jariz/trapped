<?php
/**
 * JARIZ.PRO
 * Date: 24/04/2014
 * Time: 10:22
 * Author: JariZ
 */

namespace Admin;

/**
 * Class Users
 * @package Admin
 * @author Jari Zwarts
 */
class Users extends CrudController {
    protected function getFields() {

        $roles = [];
        $in = "";
        foreach(\Model\Role::all() as $role) {
            /* @var $role \Model\Role */
            $roles[] = [
                "id" => $role->id,
                "title" => $role->name
            ];
            $in .= ",".$role->id;
        }

        return array(
            "Email" => array(
                "name" => "email",
                "type" => "text",
                "rules" => "required|email|unique:users,email"
            ),
            "Password" => array(
                "name" => "password",
                "type" => "password",
                "rules" => "required|min:3",
                "hideInOverview" => true
            ),
            "Name" => array(
                "name" => "name",
                "type" => "text",
                "rules" => ""
            ),
            "Role" => array(
                "name" => "role_id",
                "type" => "select",
                "options" => $roles,
                "rules" => "required|in:".$in,
                "property" => "name"
            )
        );
    }

    protected $model = "\\Model\\User";
    protected $singular = "User";
    protected $plural = "Users";
    protected $route = "dashboard.users";
    protected $with = "role";
} 