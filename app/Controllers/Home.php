<?php

namespace App\Controllers;

class Home extends BaseController
{
    protected $ipAddress;
    protected $session;

    public function __construct()
    {
        helper('my');
        $this->ipAddress = $_ENV['API_BASEURL'];
        $this->session = session();
        // jika tidak ada session, redirect ke login
        if (!$this->session->get('user') || !isset($this->session->get('user')['kode'])) {
            return redirect()->to('/login');
        }
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

    public function dashboard()
    {
        
        $listData   = [];
        $curlOpt    = [
            'id_member' => $this->session->get('user')['kode'],
        ];

        if(empty($listData)) $listData = getCurl($curlOpt, $this->ipAddress . 'select_statistik.php');

        return view('dashboard', [
            'title' => 'Dashboard',
            'listData' => $listData
        ]);
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
