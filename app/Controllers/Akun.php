<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use GuzzleHttp\Client;

class Akun extends BaseController
{
    protected $ipAddress;

    public function __construct()
    {
        helper('my');
        $this->ipAddress = $_ENV['API_BASEURL'];
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

        if(empty($userList)) $client = getCurl(['usernm' => '0876543210'], $this->ipAddress . 'select_user.php');
        // echo json_encode($client);
        
        if($client['success']){
            $userList = $client['result'];
        }

        return view('akun/index', ['userList' => $userList]);
    }
}
