<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Rate extends BaseController
{
    protected $helpers = ['url', 'form', 'my'];

    public function index()
    {
        // helper('my');
        return view('pages/rate/hitung');
    }

    public function orderlayanan()
    {
        return view('pages/rate/hitung');
    }

    public function lepaskunci() 
    {    
        return view('pages/rate/hitung');
    }

    public function hitung()
    {
        return view('pages/rate/hitung');
    }

}
