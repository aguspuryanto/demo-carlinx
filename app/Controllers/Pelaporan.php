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
        /*
        $hut_piu = $_POST['hut_piu'];
        $kd_member = $_POST['kd_member'];
        $tgl_1 = $_POST['tgl_awal'];
        $tgl_2 = $_POST['tgl_akhir'];
        $group = $_POST['grouped'];
        */

        $listData   = [];
        $curlOpt    = [
            'hut_piu' => '1', // 1 = hutang, 2 = piutang
            'tgl_awal' => date('01-m-Y', strtotime('-1 month')),
            'tgl_akhir' => date('t-m-Y', strtotime('-1 month')),
            'grouped' => '0',
            'kd_member' => $this->session->get('user')['kode']
        ];

        // echo ($curlOpt['tgl_awal']);
        // echo $this->parseTgl($curlOpt['tgl_awal']);
        
        // handle POST
        if ($this->request->getMethod() == 'POST') {
            $data = $this->request->getPost();
            // echo json_encode($data);

            // lakukan validasi data
            $validation =  \Config\Services::validation();
            $validation->setRules([
                'tgl_awal' => 'required',
                'tgl_akhir' => 'required',
            ]);
            $isDataValid = $validation->withRequest($this->request)->run();

            // jika data valid, maka submit
            if($isDataValid){
                // $curlOpt['hut_piu'] = $data['hut_piu'];
                $curlOpt['tgl_awal'] = $data['tgl_awal'];
                $curlOpt['tgl_akhir'] = $data['tgl_akhir'];
                // $curlOpt['grouped'] = $data['grouped'];

                $listData = getCurl($curlOpt, $this->ipAddress . 'report_hutang.php');

            } else {
                // $error['error'] = $validation->getErrors();
                $this->session->setFlashdata('error', 'Data tidak valid');
            }
        }

        if(empty($listData)) $listData = getCurl($curlOpt, $this->ipAddress . 'report_hutang.php');
        // echo json_encode($listData);
        
        return view('pages/pelaporan/hutang', [
            'title' => 'Hutang',
            'curlOpt' => $curlOpt,
            'listData' => ($listData['result_hutang']) ?? $listData,
        ]);
    }

    public function piutang()
    {
        /*
        $hut_piu = $_POST['hut_piu'];
        $kd_member = $_POST['kd_member'];
        $tgl_1 = $_POST['tgl_awal'];
        $tgl_2 = $_POST['tgl_akhir'];
        $group = $_POST['grouped'];
        */

        $listData   = [];
        $curlOpt    = [
            'hut_piu' => '1', // 1 = hutang, 2 = piutang
            'tgl_awal' => date('01-m-Y', strtotime('-1 month')),
            'tgl_akhir' => date('t-m-Y', strtotime('-1 month')),
            'grouped' => '0',
            'kd_member' => $this->session->get('user')['kode']
        ];

        // echo ($curlOpt['tgl_awal']);
        // echo $this->parseTgl($curlOpt['tgl_awal']);
        
        // handle POST
        if ($this->request->getMethod() == 'POST') {
            $data = $this->request->getPost();
            // echo json_encode($data);

            // lakukan validasi data
            $validation =  \Config\Services::validation();
            $validation->setRules([
                'tgl_awal' => 'required',
                'tgl_akhir' => 'required',
            ]);
            $isDataValid = $validation->withRequest($this->request)->run();

            // jika data valid, maka submit
            if($isDataValid){
                // $curlOpt['hut_piu'] = $data['hut_piu'];
                $curlOpt['tgl_awal'] = $data['tgl_awal'];
                $curlOpt['tgl_akhir'] = $data['tgl_akhir'];
                // $curlOpt['grouped'] = $data['grouped'];

                $listData = getCurl($curlOpt, $this->ipAddress . 'report_hutang.php');

            } else {
                // $error['error'] = $validation->getErrors();
                $this->session->setFlashdata('error', 'Data tidak valid');
            }
        }

        if(empty($listData)) $listData = getCurl($curlOpt, $this->ipAddress . 'report_hutang.php');
        // echo json_encode($listData);

        return view('pages/pelaporan/piutang', [
            'title' => 'Piutang',
            'curlOpt' => $curlOpt,
            'listData' => ($listData['result_hutang']) ?? $listData,
        ]);
    }

    public function statusPembayaran()
    {
        return view('pages/pelaporan/status-pembayaran', ['title' => 'Status Pembayaran']);
    }

    public function verifikasiPembayaran()
    {
        return view('pages/pelaporan/verifikasi-pembayaran', ['title' => 'Verifikasi Pembayaran']);
    }

    public function parseTgl($tgl_1)
    {
        $parsingstart = explode("-",$tgl_1);
        $tgl_start = $parsingstart[0];
        $bln_start = $parsingstart[1];
        $thn_start = SUBSTR($parsingstart[2], 0, 4);
        $tgl_new_start = $thn_start."/".$bln_start."/".$tgl_start;
        $tgl_start = date('Y-m-d',strtotime($tgl_new_start));

        return $tgl_start;
    }
}
