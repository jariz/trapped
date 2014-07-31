<?php
/**
 * JARI.IO
 * Date: 29-7-14
 * Time: 3:23
 */

namespace Admin;

use Model\Exclusive;

class Exclusives extends CrudController {
    protected function getFields()
    {
        return [
            "Title" => [
                "type" => "text",
                "rules" => "required",
                "name" => "title"
            ],
            "SoundCloud link" => [
                "type" => "text",
                "rules" => "required|url",
                "name" => "link"
            ],
            "URL" => [
                "type" => "text-with-prepend",
                "rules" => "required|alpha_dash",
                "name" => "slug",
                "prepend" => \URL::to("/exclusives")."/"
            ],
            "Description" => [
                "type" => "wysiwyg",
                "rules" => "",
                "name" => "desc",
                "hideInOverview" => true
            ],
            "Download" => [
                "type" => "download",
                "name" => "download",
                "rules" => "",
                "hideInOverView" => true
            ]
        ];
    }

    protected $timestamps  = true;
    protected $model = "\\Model\\Exclusive";
    protected $singular = "Exclusive";
    protected $plural = "Exclusives";
    protected $route = "dashboard.exclusives";

} 