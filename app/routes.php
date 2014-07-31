<?php

//FRONT
Route::get("/", "Front\\Site@home");
Route::get("hot", "Front\\Site@hot");
Route::get("hot/{subreddit}", array("uses" => "Front\\Site@hot", "before" => "valid.subreddit"));
Route::get("top", "Front\\Site@top");
Route::get("top/{subreddit}", array("uses" => "Front\\Site@top", "before" => "valid.subreddit"));
Route::get("about", "Front\\Site@about");
Route::get("blog", "Front\\Site@blog");
Route::get("exclusives", "Front\\Site@exclusives");
Route::get("exclusives/{exclusive}", "Front\\Site@exclusive");
Route::get("radio", "Front\\Site@radio");
Route::get("radio/api", "Front\\Site@radioApi");

//BACK
Route::get("dashboard", array("as" => "dashboard", "uses" => "\\Admin\\Dashboard@show"));
Route::get("dashboard/login", array("as" => "dashboard.login", "uses" => "\\Admin\\Login@show"));
Route::get("dashboard/forgot/{code}/{id}", array("as" => "dashboard.forgot", "uses" => "\\Admin\\Login@forgot"));
Route::post("dashboard/login", array("as" => "dashboard.do-login", "uses" => "\\Admin\\Login@run", "before" => "csrf"));
Route::get("dashboard/logout/{csrf}", array("as" => "dashboard.logout", "uses" => "\\Admin\\Login@destroy"));
Route::post("dashboard/forgot", array("as" => "dashboard.do-forgot", "uses" => "\\Admin\\Login@doForgot", "before" => "csrf"));
Route::post("dashboard/changepwd", array("as" => "dashboard-changepwd", "uses" => "\\Admin\\Login@changePassword", "before" => "csrf"));
Route::get("dashboard/login", array("as" => "dashboard.login", "uses" => "\\Admin\\Login@show"));
Route::get("dashboard/settings", array("as" => "dashboard.settings", "uses" => "\\Admin\\Settings@show"));
Route::post("dashboard/settings", array("as" => "dashboard.do-settings", "uses" => "\\Admin\\Settings@run", "before" => "csrf"));

$crudControllers = Config::get("trapped.crud");
foreach($crudControllers as $route => $controller) {
    Route::get("dashboard/{$route}", array("as" => "dashboard.{$route}", "uses" => "{$controller}@overview", "before"=>"haspermission"));
    Route::get("dashboard/{$route}/add", array("as" => "dashboard.{$route}-add", "uses" => "{$controller}@showEdit", "before"=>"haspermission"));
    Route::get("dashboard/{$route}/edit/{id}", array("as" => "dashboard.{$route}-edit", "uses" => "{$controller}@showEdit", "before"=>"haspermission"));
    Route::post("dashboard/{$route}/delete", array("as" => "dashboard.{$route}-delete", "uses" => "{$controller}@delete", "before"=>"haspermission"));
    Route::post("dashboard/{$route}/edit", array("as" => "dashboard.{$route}-doedit", "uses" => "{$controller}@edit", "before"=>"haspermission"));
    Route::post("dashboard/{$route}/restore", array("as" => "dashboard.{$route}-dorestore", "uses" => "{$controller}@restore", "before"=>"haspermission"));
    Route::get("dashboard/{$route}/trash", array("as" => "dashboard.{$route}-trash", "uses" => "{$controller}@trash", "before"=>"haspermission"));
    Route::post("dashboard/{$route}/perm-delete", array("as" => "dashboard.{$route}-perm-delete", "uses" => "{$controller}@permDelete", "before"=>"haspermission"));
}