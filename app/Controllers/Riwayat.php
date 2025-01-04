<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Riwayat extends BaseController
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
        /* params: 
         * caller optional
         * kd_member required
         */

        $listData   = [];
        $curlOpt    = [
            'caller' => 'RIWAYAT', // default. INBOX, AKTIF, RIWAYAT
            'kd_member' => $this->session->get('user')['kode']
        ];

        //update status terbaru
        // 1 = baru; 2 = diterima; 3 = data plgn; 4 = data driver + invoice;
        // 5 = konfirmasi bayar (upload bukti transfer)
        // 6 = tolak by rental; 7 = batal by rental; 8 = batal by pemesan
        // 9 = pembayaran diterima (order selesai - ke menu Proses)
        $listStatus = [
            '1' => 'Baru',
            '2' => 'Diterima',
            '3' => 'Data Plgn',
            '4' => 'Data Driver + Invoice',
            '5' => 'Konfirmasi Bayar',
            '6' => 'Tolak By Rental',
            '7' => 'Batal By Rental',
            '8' => 'Batal By Pemesan',
            '9' => 'Pembayaran Diterima'
        ];

        // grp_penyewa
        $listGroup = [
            '2' => 'In',
            '1' => 'Out',
        ];

        // jns_order
        $listOrder = [
            '1' => 'Pelayanan',
            '2' => 'Lepas Kunci',
            // '3' => 'Mobil',
            '4' => 'Bulanan',
            // '5' => 'Paket',
        ];

        if(empty($listData)) $listData = getCurl($curlOpt, $this->ipAddress . 'select_order_5.php');
        // echo json_encode($listData); die();
        if($listData['success']){
            $listData = $listData;
        }

        return view('riwayat/index', [
            'title' => 'Riwayat',
            'listStatus' => $listStatus,
            'listGroup' => $listGroup,
            'listOrder' => $listOrder,
            'listData' => ($listData['result_list_order']) ?? $listData
        ]);
    }
}
