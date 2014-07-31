<?php
/**
 * JARIZ.PRO
 * Date: 24/04/2014
 * Time: 09:39
 * Author: JariZ
 */

namespace Admin;

/**
 * Class AdminController
 * Does common procedures for admin tasks.
 * @package Admin
 */
class AdminController extends \Controller {
    public function __construct() {
        \View::share("title", "NO TITLE");
        $this->beforeFilter("auth");
    }
} 