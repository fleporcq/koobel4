<?php

/**
 * Created by IntelliJ IDEA.
 * User: fleporcq
 * Date: 28/01/15
 * Time: 17:53
 */
class SecurityController extends BaseController
{

    public function showLogin()
    {
        return View::make('security/login');
    }

    public function login()
    {

        $userData = array(
            "email" => Input::get("email"),
            "password" => Input::get("password")
        );

        if (Auth::attempt($userData)) {
            return Redirect::to(URL::action("HomeController@index"));
        }

        return Redirect::to(URL::action("SecurityController@login"))->with("error", Lang::get('messages.loginError'));

    }

    public function logout()
    {
        Auth::logout();
        return Redirect::to(URL::action('SecurityController@login'));
    }
}