<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Rate extends BaseController
{
    public function index()
    {
        //
        return view('pages/rate/hitung');
    }
}
