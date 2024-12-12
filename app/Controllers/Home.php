<?php

namespace App\Controllers;

class Home extends BaseController
{
    protected $session;

    public function __construct()
    {
        // Memulai session
        $this->session = session();
    }

    public function index()
    {
        // Cek apakah pengguna sudah login
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // return view('welcome_message');
        // Jika sudah login, tampilkan halaman Home
        return view('home', ['title' => 'Home']);
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
