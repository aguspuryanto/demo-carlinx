<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
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
        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $userModel = new \App\Models\User();
            $user = $userModel->where('email', $email)->first();

            if ($user && password_verify($password, $user['password'])) {
                session()->set('logged_in', true);
                return redirect()->to('/dashboard');
            }
            return redirect()->back()->with('error', 'Invalid credentials.');
        }
        return view('auth/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

}
