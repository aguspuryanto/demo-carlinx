<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    protected $ipAddress;

    public function __construct()
    {
        helper('my');
        $this->ipAddress = $_ENV['API_BASEURL'];
    }

    public function index()
    {
        //
    }

    public function register()
    {
        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();
            $userModel = new \App\Models\User();
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
            $userModel->insert($data);
            return redirect()->to('/login');
        }
        return view('auth/register');
    }

    public function login()
    {
        return view('auth/login', ['title' => 'Login']);
    }

    public function loginSubmit()
    {
        $session = session();
        // $userModel = new \App\Models\User();

        // Ambil data input dari form
        $username = $this->request->getPost('username'); //0876543210
        $password = $this->request->getPost('password'); //123456

        // Cari pengguna berdasarkan email
        // $user = $userModel->getUserByEmail($email);

        $userData = getCurl(['usernm' => $username], $this->ipAddress . 'select_user.php');
        // echo json_encode($userData); die();
        if($userData){
            $userData['password'] = password_hash($password, PASSWORD_BCRYPT);
        }

        if ($userData && password_verify($password, $userData['password'])) {
            // Simpan data pengguna ke session
            $session->set('isLoggedIn', true);
            $session->set('user', $userData['result'][0]);

            return redirect()->to('/');
        } else {
            return redirect()->back()->with('error', 'Email atau password salah!');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

}
