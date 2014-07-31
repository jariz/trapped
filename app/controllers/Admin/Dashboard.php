<?php
/**
 * JARIZ.PRO
 * Date: 24/04/2014
 * Time: 09:38
 * Author: JariZ
 */

namespace Admin;


use Trapped\User;
use Model\Permission;

class Dashboard extends AdminController {
    public function show() {

        $cruds = array();
        foreach(\Config::get("trapped.crud") as $route => $class) {
            if(!User::can("dashboard.".$route)) continue;
            $crud = new $class;
            /* @var $crud \Admin\CrudController */
            $viewcrud = new \stdClass();
            $fields_ = $crud->fields();
            $meta = $crud->meta();
            $fields = array();
            foreach ($fields_ as $key => $field) {
                if (isset($field["hideInOverview"]) && $field["hideInOverview"] === true)
                    continue;
                $fields[$key] = $field;
            }
            $model = $crud->model();

            //if a approve permission exists, check if the user has access to it.
            if(Permission::whereAlias("dashboard.{$route}-approve")->count() > 0) {
                if(!User::can("dashboard.{$route}-approve")) {
                    $model = $model->whereUserId(\Auth::user()->id);
                }
            }
            $viewcrud->columns = $fields;
            $viewcrud->data = $model->take(5)->get();
            $viewcrud->count = $model->count();
            $viewcrud->plural = $meta["plural"];
            $viewcrud->route = $meta["route"];
            $viewcrud->with = $meta["with"];

            $cruds[] = $viewcrud;
        }

        return \View::make("admin.dashboard")
            ->with("cruds", $cruds)
            ->with("title", "Dashboard");
    }
} 