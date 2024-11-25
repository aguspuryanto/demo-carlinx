<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // return view('welcome_message');
        return view('home');
    }

    public function profile()
    {
        return view('profile');
    }

    public function chat()
    {
        return view('chat');
    }
}
