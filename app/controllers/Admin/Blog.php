<?php
/**
 * JARI.IO
 * Date: 29-7-14
 * Time: 3:23
 */

namespace Admin;

use Model\User;

class Blog extends CrudController
{
    protected function getFields()
    {
        $users = User::all(["name", "id"]);
        $names = [];
        foreach ($users as $user) {
            $names[] = [
                "id" => $user->id,
                "title" => $user->name
            ];
        }

        return [
            "Title" => [
                "type" => "text",
                "rules" => "required",
                "name" => "title"
            ],
            "Description" => [
                "type" => "wysiwyg",
                "rules" => "",
                "name" => "content",
                "hideInOverview" => true
            ],
            "Author" => [
                "name" => "user_id",
                "rules" => "required|exists:users,id",
                "options" => $names,
                "type" => "select",
                "property" => 'name'
            ]
        ];
    }

    protected $timestamps = true;
    protected $model = "\\Model\\Blog";
    protected $singular = "Blog post";
    protected $plural = "Blog posts";
    protected $route = "dashboard.blog";
    protected $with = "author";

} 