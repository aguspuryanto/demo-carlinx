<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Event extends BaseController
{
    public function index()
    {
        //
        return view('event/index', ['title' => 'Event']);
    }
}
