<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use GuzzleHttp\Client;

class Akun extends BaseController
{
    protected $ipAddress = 'http://103.178.174.7/foxrent/';
    // protected $helpers = ['my_helper'];

    public function __construct()
    {
        // load helper
        helper('my');
    }

    public function index()
    {
        $userList = [];

        $client = getCurl([
            'usernm' => '0876543210',
        ], $this->ipAddress . 'select_user.php');

        // echo json_encode($client);
        if($client['success']){
            $userList = $client['result'];
        }

        return view('index', ['userList' => $userList]);
    }
}
