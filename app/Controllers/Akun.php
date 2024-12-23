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

        // $client = new Client();
        // $response = $client->request('POST', $this->ipAddress . 'select_user.php', [
        //     'form_params' => [
        //         'usernm' => '0876543210'
        //     ]
        // ]);
        // $data = json_decode($response->getBody()->getContents(), true);

        $data = getCurl(['usernm' => '0876543210'], $this->ipAddress . 'select_user.php');
        if($data['success']){
            $userList = $data['result'];
        }

        return view('akun/index', ['userList' => $userList]);
    }
}
