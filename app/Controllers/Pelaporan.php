<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Pelaporan extends BaseController
{
    protected $ipAddress;
    protected $session;

    public function __construct()
    {
        helper('my');
        $this->ipAddress = $_ENV['API_BASEURL'];
        $this->session = session();
        // jika tidak ada session, redirect ke login
        if (!$this->session->get('user') || !isset($this->session->get('user')['kode'])) {
            return redirect()->to('/login');
        }
    }
    
    public function index()
    {
        //
        $listData = ['Order Masuk', 'Order Keluar', 'Hutang', 'Piutang', 'Status Pembayaran', 'Verifikasi Pembayaran'];

        return view('pages/pelaporan/index', ['title' => 'Pelaporan', 'listData' => $listData]);
    }

    public function orderMasuk()
    {
        return view('pages/pelaporan/order-masuk', ['title' => 'Order Masuk']);
    }

    public function orderKeluar()
    {
        return view('pages/pelaporan/order-keluar', ['title' => 'Order Keluar']);
    }

    public function hutang()
    {
        return view('pages/pelaporan/hutang', ['title' => 'Hutang']);
    }

    public function piutang()
    {
        return view('pages/pelaporan/piutang', ['title' => 'Piutang']);
    }

    public function statusPembayaran()
    {
        return view('pages/pelaporan/status-pembayaran', ['title' => 'Status Pembayaran']);
    }

    public function verifikasiPembayaran()
    {
        return view('pages/pelaporan/verifikasi-pembayaran', ['title' => 'Verifikasi Pembayaran']);
    }
}
