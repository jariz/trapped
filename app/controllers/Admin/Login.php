<?php

namespace Admin;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Mail\Message;
use Illuminate\Support\MessageBag;
use Model\User;

class Login extends \Controller {

    /**
     * Display the login form.
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @author Jari Zwarts
     */
    public function show() {
        //already logged in? send to dashboard.
        if(\Auth::check()) return \Redirect::route("dashboard");

        //display login form
        return \View::make("admin.login");
    }

    /**
     * Run the actual login.
     * @return array|\Illuminate\View\View
     * @author Jari Zwarts
     */
    public function run() {
        //we only want the 2 fields we're gonna validate and use to authenticate.
        $input = \Input::only(array('email', 'password'));

        //our error bag that will hold all messages this function will produce
        $errors = new MessageBag();

        //create the validator and it's rules.
        $validator = \Validator::make($input, array(
            "email" => "required|email",
            "password" => "required"
        ));


        $rememberMe = false;
        if( \Input::get('remember-me') == 1){
               $rememberMe = true;
        }


        //does the validator pass? if yes, attempt to authenticate the user, else, add error messages to our error bag.
        if($validator->fails())
            $errors->merge($validator->errors());
        else if(!\Auth::attempt($input, $rememberMe))
            $errors->add("authfailed", "Credentials are incorrect.");

        //are there are errors? if so, display the login form again, with the errors, respectfully.
        //else, redirect user to dashboard.
        if($errors->any())
            return \View::make("admin.login")->with("errors", $errors);
        else return \Redirect::intended("dashboard");
    }

    /**
     * The action that processes password change requests.
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @author Jari Zwarts
     */
    public function changePassword() {
        $validator = \Validator::make(
            \Input::only(["password", "id", "reset_code"]),
            [
                "id" => "required",//|exists:users,id",
                "reset_code" => "required",//|exists:users,reset_code",
                "password" => "required"
            ]
        );

        if($validator->fails()) {
            $user = User::whereId(intval(\Input::get("id")))->whereResetCode(\Input::get("reset_code"))->first();
            if(!$user) {
                return \View::make("admin.nice-error", [
                    "title" => "Password change failed",
                    "message" => $validator->messages()->first()
                ]);
            } else {
                return \View::make("admin.forgot")->with("user", $user)->withErrors($validator->errors());
            }
        } else {
            $user = User::findOrFail(intval(\Input::get("id")));
            $user->password = \Hash::make(\Input::get("password"));
            $user->reset_code = "";
            $user->save();
            return \Redirect::route("dashboard.login")->with("relogin", true);
        }
    }

    /**
     * Display the password change form.
     * @param $code string The user's reset code which was emailed to him.
     * @param $id int The user's id.
     * @return \Illuminate\View\View
     * @author Jari Zwarts
     */
    public function forgot($code, $id) {
        try {
            $user = User::whereResetCode($code)->whereId($id)->firstOrFail();
        } catch(ModelNotFoundException $e) {
            \App::abort(403);
        }

        return \View::make("admin.forgot", [
            "user" => $user
        ]);
    }

    public function doForgot() {
        //create mbag
        $errors = new MessageBag();

        //create validator
        $validator = \Validator::make(
            \Input::only(array("email")),
            [
                "email" => "required|email|exists:users,email"
            ]
        );

        //does the validator pass? if yes send emails, if no, add error message to bag
        if($validator->fails()) {
            $errors = $validator->errors();
        } else {
            //get user
            $user = User::whereEmail(\Input::get("email"))->firstOrFail();

            //generate unique reset code
            $resetcode = \Str::random(20);

            //set reset code
            $user->reset_code = $resetcode;
            $user->save();

            //build & send mail
//            return \View::make(
            \Mail::send(
            "emails.forgot", [
                "link" => \URL::route("dashboard.forgot", [
                        "id" => $user->id,
                        "code" => $resetcode
                    ]),
                "logo" => url("images/logo.png"),
                "name" => $user->name
            ]
            , function(Message $message) use($user) {
                $message->to($user->email);
                $message->subject("Wachtwoord reset - Fairtrade Amsterdam");
                $message->from("amsterdam@fairtradegemeenten.nl");
            });

//            );

            return \View::make("admin.login", ["forgot" => true, "mailsend" => true]);
        }

        return \View::make("admin.login", ["forgot" => true])->withErrors($errors);
    }

    /**
     * Destroy the session and go back to the homepage.
     * @author Jari Zwarts
     */
    public function destroy($csrf) {
        if($csrf != \Session::token()) \App::abort(403);
        \Auth::logout();
        return \Redirect::intended();
    }
} 