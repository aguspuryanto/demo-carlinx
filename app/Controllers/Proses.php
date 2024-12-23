<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Proses extends BaseController
{
    public function index()
    {
        //
        return view('proses/index', ['title' => 'Proses']);
    }
}
