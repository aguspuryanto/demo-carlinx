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
        $jabatan = ['0' => 'CEO', '1' => 'DIREKTUR', '2' => 'MANAGER'];
        $cityList = [];

        if ($this->request->getMethod() === 'post') {
            $data = $this->request->getPost();
            echo json_encode($data);

            // $nama = $_POST['nama'];
            // $alamat_perush = $_POST['alamat'];
            // $kd_kota = $_POST['kd_kota'];
            // $nama_perush = $_POST['nama_perush'];
            // $ijin_perush = $_POST['ijin_perush'];
            // $email = $_POST['email_addr'];
            // $layanan = $_POST['layanan'];
            // $event = $_POST['event'];
            // $bulanan = $_POST['bulanan'];
            // $lepaskunci = $_POST['lepaskunci'];
            // $grup = $_POST['grup'];
            // $jabatan = $_POST['jabatan'];
            // $nohp_0 = $_POST['usernm'];
            // $secode_0 = $_POST['passwd'];
            // $secode = password_hash($secode_0,PASSWORD_DEFAULT);
            // $kd_korwil = $_POST['kd_korwil'];

            // $userModel = new \App\Models\User();
            // $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
            // $userModel->insert($data);
            // return redirect()->to('/login');

            // reg_user_2.php
        }

        if(empty($cityList)) $cityList = getCurl([], $this->ipAddress . 'select_kota_1.php');
        // echo json_encode($cityList);

        return view('auth/register', [
            'title' => 'Register',
            'jabatan' => $jabatan,
            'cityList' => $cityList
        ]);
    }

    public function login()
    {
        return view('auth/login', ['title' => 'Login']);
    }

    public function loginSubmit()
    {
        $session = session();

        // Ambil data input dari form
        $username = $this->request->getPost('username'); //0876543210
        $password = $this->request->getPost('password'); //123456

        $userData = getCurl(['usernm' => $username], $this->ipAddress . 'select_user.php'); //curl -m 15 -X POST -d "usernm=0876543210" http://103.178.174.7/foxrent/select_user.php
        // echo json_encode($userData); die();
        if($userData){
            $userData['password'] = password_hash($password, PASSWORD_BCRYPT);
        }

        if ($userData['success'] == "1" && password_verify($password, $userData['password'])) {
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
