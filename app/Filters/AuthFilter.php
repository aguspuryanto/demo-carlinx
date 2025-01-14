<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Cek apakah session 'isLoggedIn' ada dan true
        // if (!session()->get('isLoggedIn')) {
        //     // return redirect()->to('/login')->with('error', 'Please login to access this page.');
        // }

        $session = session();
        if(!$session->has('user')) {
            // return redirect()->to('/login'); 
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada tindakan setelah request
    }
}
