<?php

namespace Admin;

/**
 * Class Subreddits
 * @package Admin
 * @author Jari Zwarts
 */
class Subreddits extends CrudController {
    protected function getFields() {
        return [
            "Subreddit name" => [
                "name" => "name",
                "type" => "text",
                "rules" => "required|alpha_dash"
            ],
            "Subeddit label" => [
                "name" => "label",
                "type" => "text",
                "rules" => "required"
            ]
        ];
    }

    protected $model = "\\Model\\Subreddit";
    protected $singular = "Subreddit";
    protected $plural = "Subreddits";
    protected $route = "dashboard.subreddits";
} 