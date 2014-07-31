<?php

namespace Admin;
use Illuminate\Support\MessageBag;

class Settings extends AdminController {
    public function show() {
        return \View::make("admin.settings")->with("data", \Auth::user()->toArray())->with("title", "User settings");
    }

    public function run() {
        //get current user
        $user = \Auth::user();

        //create messagebag which will hold all errors outputted by the application
        $errors = new MessageBag();

        //create validator
        $validator = \Validator::make($data = \Input::only([
            "email",
            "new_password",
            "new_password_confirm",
            "current_password"
        ]), [
            "email" => "required|email",
            "new_password" => "",
            "new_password_confirm" => "same:new_password",
            "current_password" => "required"
        ]);

        //run validator
        if($validator->fails()) {
            $errors->merge($validator->errors());
        } else {
            //validator didn't fail. attempt to find out what it is the user wants

            //first check if the current password is correct
            if(!\Hash::check(\Input::get("current_password"), $user->password)) {
                $errors->add("wrongpassword", "Curren't password isn't correct");
            } else {
                //now check if we want to change the password
                if(\Input::get("new_password") != "") {
                    $user->password = \Hash::make(\Input::get("new_password"));
                }
                //change the email eitherway (it gets prefilled with the current email)
                $user->email = \Input::get("email");
            }
        }

        if($errors->any())
            return \View::make("admin.settings")->with("data", $data)->with("errors", $errors)->with("title", "User settings");
        else {
            $user->save();
            \Auth::logout();
            return \Redirect::to(\URL::route("dashboard.login"))->with("relogin", true);
        }
    }
}