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
        // params
        // $in_out = $_POST['in_out'];// 1 = in, 2 = out
        // $kd_member = $_POST['kd_member'];
        // $tgl_1 = $_POST['tgl_awal'];
        // $tgl_2 = $_POST['tgl_akhir'];
        // $group = $_POST['grouped'];

        if(!isset($this->session->get('user')['kode'])) return redirect()->to('/login');

        $listData = [];
        $curlOpt = [
            'in_out' => 1,
            'kd_member' => $this->session->get('user')['kode'],
            'tgl_awal' => date('01-m-Y'),
            'tgl_akhir' => date('t-m-Y'),
        ];
        // echo json_encode($curlOpt); die();

        // handle POST
        if ($this->request->getMethod() == 'POST') {
            $data = $this->request->getPost();
            // echo json_encode($data);

            // lakukan validasi data
            $validation =  \Config\Services::validation();
            $validation->setRules([
                'in_out' => 'required',
                // 'kd_member' => 'required',
                'tgl_awal' => 'required',
                'tgl_akhir' => 'required',
                // 'grouped' => 'required',
            ]);
            $isDataValid = $validation->withRequest($this->request)->run();

            // jika data vlid, maka submit
            if($isDataValid){
                $submitData = getCurl([
                    'in_out' => $data['in_out'],
                    'kd_member' => $this->session->get('user')['kode'],
                    'tgl_awal' => $data['tgl_awal'],
                    'tgl_akhir' => $data['tgl_akhir'],
                ], $this->ipAddress . 'report_order_1.php');
                // echo json_encode($submitData);
                if($submitData['success'] == '1'){
                    $this->session->setFlashdata('success', 'Data berhasil disimpan');
                } else {
                    $this->session->setFlashdata('error', 'Data gagal disimpan');
                }

            } else {
                $this->session->setFlashdata('error', 'Data tidak valid');
            }
        }

        // echo json_encode($curlOpt);
        if(empty($listData)) $listData = getCurl($curlOpt, $this->ipAddress . 'report_order_1.php');
        // echo json_encode($listData); die();

        return view('pages/pelaporan/order-masuk', ['title' => 'Order Masuk', 'listData' => $listData['result_report_order']]);
    }

    public function orderKeluar()
    {
        // params
        // $in_out = $_POST['in_out'];// 1 = in, 2 = out
        // $kd_member = $_POST['kd_member'];
        // $tgl_1 = $_POST['tgl_awal'];
        // $tgl_2 = $_POST['tgl_akhir'];
        // $group = $_POST['grouped'];

        if(!isset($this->session->get('user')['kode'])) return redirect()->to('/login');

        $listData = [];
        $curlOpt = [
            'in_out' => 2,
            'kd_member' => $this->session->get('user')['kode'],
            'tgl_awal' => date('01-m-Y'),
            'tgl_akhir' => date('t-m-Y'),
        ];
        // echo json_encode($curlOpt); die();

        // handle POST
        if ($this->request->getMethod() == 'POST') {
            $data = $this->request->getPost();
            // echo json_encode($data);

            // lakukan validasi data
            $validation =  \Config\Services::validation();
            $validation->setRules([
                'in_out' => 'required',
                // 'kd_member' => 'required',
                'tgl_awal' => 'required',
                'tgl_akhir' => 'required',
                // 'grouped' => 'required',
            ]);
            $isDataValid = $validation->withRequest($this->request)->run();

            // jika data vlid, maka submit
            if($isDataValid){
                $submitData = getCurl([
                    'in_out' => $data['in_out'],
                    'kd_member' => $this->session->get('user')['kode'],
                    'tgl_awal' => $data['tgl_awal'],
                    'tgl_akhir' => $data['tgl_akhir'],
                ], $this->ipAddress . 'report_order_1.php');
                // echo json_encode($submitData);
                if($submitData['success'] == '1'){
                    $this->session->setFlashdata('success', 'Data berhasil disimpan');
                } else {
                    $this->session->setFlashdata('error', 'Data gagal disimpan');
                }

            } else {
                $this->session->setFlashdata('error', 'Data tidak valid');
            }
        }

        // echo json_encode($curlOpt);
        if(empty($listData)) $listData = getCurl($curlOpt, $this->ipAddress . 'report_order_1.php');
        // echo json_encode($listData); die();

        return view('pages/pelaporan/order-keluar', ['title' => 'Order Keluar', 'listData' => $listData]);
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
