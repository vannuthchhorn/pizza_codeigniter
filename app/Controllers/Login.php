<?php namespace App\Controllers;

class Login extends BaseController
{
	public function index()
	{
		return view('auths/login');
    }
    public function btnCreateAccount()
    {
        return view('auths/register');
    }
    public function btnSigninAccount(){
        return view('auths/login');
    }
    public function logined()
    {
        return view('index');
    }
}