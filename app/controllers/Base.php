<?php

class Base extends Controller {
    function __construct()
    {
        View::share("plain", Input::has("plain"));
    }


}