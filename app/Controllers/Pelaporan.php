<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Pelaporan extends BaseController
{
    public function index()
    {
        //
        $listData = ['Order Masuk', 'Order Keluar', 'Hutang', 'Piutang', 'Status Pembayaran', 'Verifikasi Pembayaran'];

        return view('pages/pelaporan/index', ['title' => 'Pelaporan', 'listData' => $listData]);
    }

    public function orderMasuk()
    {
        return view('pages/pelaporan/order-masuk');
    }

    public function orderKeluar()
    {
        return view('pages/pelaporan/order-keluar');
    }

    public function hutang()
    {
        return view('pages/pelaporan/hutang');
    }

    public function piutang()
    {
        return view('pages/pelaporan/piutang');
    }

    public function statusPembayaran()
    {
        return view('pages/pelaporan/status-pembayaran');
    }

    public function verifikasiPembayaran()
    {
        return view('pages/pelaporan/verifikasi-pembayaran');
    }
}
