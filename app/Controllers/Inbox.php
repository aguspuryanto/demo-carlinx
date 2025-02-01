<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Inbox extends BaseController
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
            'caller' => 'INBOX', // default. INBOX, AKTIF, RIWAYAT
            'kd_member' => $this->session->get('user')['kode']
        ];

        //update status terbaru
        // 1 = baru; 2 = diterima; 3 = data plgn; 4 = data driver + invoice;
        // 5 = konfirmasi bayar (upload bukti transfer)
        // 6 = tolak by rental; 7 = batal by rental; 8 = batal by pemesan
        // 9 = pembayaran diterima (order selesai - ke menu Proses)

        // sisi pemesan
        // Stat : 1 = Menunggu
        // Stat : 4 = Butuh Tindakan
        // Stat : 5 = Menunggu
        // Stat : 6 = Ditolak
        // Stat : 7 = Rental Batal
        // Stat : 8 = Kedaluwarsa
        // Stat : 9 = Selesai

        // sisi rental
        // Stat : 1 = Order Baru
        // Stat : 4 = Menunggu
        // Stat : 5 = Tunggu Pembayaran
        // Stat : 6 = Ditolak
        // Stat : 7 = Rental Batal
        // Stat : 8 = Pemesan Batal
        // Stat : 9 = Selesai

        $listStatus = [
            '1' => 'Menunggu',
            '2' => 'Diterima',
            '3' => 'Data Plgn',
            '4' => 'Butuh Tindakan',
            '5' => 'Menunggu',
            '6' => 'Ditolak', //'Tolak By Rental',
            '7' => 'Rental Batal',
            '8' => 'Kedaluwarsa', //'Batal By Pemesan',
            '9' => 'Selesai', //'Pembayaran Diterima'
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

        $newlistData = [];
        if($listData['success']=='1'){
            foreach ($listData['result_list_order'] as $item) {
                // echo $item['stat'];
                if(in_array($item['stat'], ['1', '2', '3', '4', '5'])) $newlistData[] = $item;
            }
        }
        // echo json_encode($newlistData);

        if($listData['success']){
            $listData = $listData;
        }

        return view('inbox/index', [
            'title' => 'Inbox',
            'listStatus' => $listStatus,
            'listGroup' => $listGroup,
            'listOrder' => $listOrder,
            'newlistData' => $newlistData,
            'listData' => $listData
        ]);
    }

    public function confirm()
    {
        // handle POST
        if ($this->request->getMethod() == 'POST') {
            $data = $this->request->getPost();
            // echo json_encode($data); die();
            // $id_order = $this->request->getPost('id_order');
            // $pelanggan = $this->request->getPost('pelanggan');
            // $stat_ori = $this->request->getPost('stat_ori');
            
            if (!$data['id_order'] || !$data['pelanggan']) {
                // return redirect()->to(base_url('inbox'))->with('error', 'Please fill in all required fields');
                $response = [
                    'success' => false,
                    'message' => 'Please fill in all required fields'
                ];
                echo json_encode($response);
                return;
            }

            // $caller = $_POST['caller'];
            // $kd_member = $_POST['kd_member'];
            // $id_order = $_POST['id_order'];		
            // $stat_ori = $_POST['stat_ori'];
            // $stat = $_POST['stat'];
            // $alasan_batal = $_POST['alasan_batal'];

            // update_order_1a.php
            $curlOpt    = [
                'caller' => 'INBOX', // default. INBOX, AKTIF, RIWAYAT
                'kd_member' => $this->session->get('user')['kode'],
                'id_order' => $data['id_order'],
                'stat_ori' => $data['stat_ori'],
                'stat' => 8, //batal
                'alasan_batal' => '-'
            ];

            $listData   = getCurl($curlOpt, $this->ipAddress . 'update_order_1a.php');
            // echo json_encode($listData); die();

            $response = [
                'success' => ($listData['success']=='1') ? true : false,
                'message' => $listData['message']
            ];

            echo json_encode($response);

            // return redirect()->to(base_url('inbox'))->with('success', 'Order confirmed successfully');
        }
    }
}
