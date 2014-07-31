<?php
/**
 * Created by IntelliJ IDEA.
 * User: JariZ
 * Date: 18-4-14
 * Time: 17:57
 */

return array(
    "cache_age" => 5, //todo todo todo FIXME
    "radio_cache_age" => 1,
    "nav" => array(
        "Hot" => "hot",
        "Top" => "top",
        "Radio" => "radio",
        "Exclusives" => "exclusives",
        "Blog" => "blog",
        "About" => "about"
    ),
    "admin_nav" => array(
        "Users" => "dashboard.users",
        "Subreddits" => "dashboard.subreddits",
        "Exclusives" => "dashboard.exclusives",
        "Blog" => "dashboard.blog"
    ),

    "crud" => array(
        "users" => '\Admin\Users',
        "subreddits" => '\Admin\Subreddits',
        "exclusives" => '\Admin\Exclusives',
        "blog" => '\Admin\Blog'
    ),
    "radio_url" => "http://radio.trapped.io:8000/status2.xsl",
    "airtime_url" => "http://radio.trapped.io/api/live-info/"
);