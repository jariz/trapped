<?php
/**
 * Created by PhpStorm.
 * User: ssshenkie
 * Date: 5/1/14
 * Time: 1:21 PM
 */

namespace Trapped;

use Illuminate\Database\Query\Builder;
use Model\Permission;
use Model\RolePermission;

class User {

    public static function isAdmin(){
        if( \Auth::guest() )
            return false;

        if( \Auth::user()->role_id == 1)
           return true;

        return false;
    }

    static $permissionCache = [];

    /**
     * Returns whether the current user has the specified permission.
     * @param $alias string The permission you want to check
     * @return bool
     * @author Jari Zwarts
     */
    public static function can($alias)
    {
        //sanity check
        if (!\Auth::check()) {
//            \Debugbar::addMessage("[PERMISSIONS] Checking if current user can {$alias} ... >>> Nope. (not logged in?!)");
            return false;
        }

        //does the cache exist?
        if (count(self::$permissionCache) == 0) {
//            \Debugbar::addMessage("No cache found, filling it...");

            //get user's role id
            $role_id = \Auth::user()->role_id;

            //get all permission id's this user has access to
            $rolepermissions = RolePermission::where("role_id", "=", $role_id)->get();

            //get their aliases
            $permissions = Permission::whereNested(function (Builder $query) use ($rolepermissions) {
                foreach ($rolepermissions as $rolepermission) {
                    $query->orWhere("id", "=", $rolepermission->permission_id);
                }
            });

            $permissions = $permissions->get();

            //add them to the cache
            foreach($permissions as $permission)
                self::$permissionCache[] = $permission->alias;
        }

        $result = in_array($alias, self::$permissionCache);
//        \Debugbar::addMessage("[PERMISSIONS] Checking if current user can {$alias} ... >>> " . ($result ? "Yes" : "Nope"));
        return $result;
    }

}