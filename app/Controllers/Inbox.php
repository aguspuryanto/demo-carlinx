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
        $listStatus = [
            '1' => 'Baru',
            '2' => 'Diterima',
            '3' => 'Data Plgn',
            '4' => 'Data Driver + Invoice',
            '5' => 'Konfirmasi Bayar',
            '6' => 'Ditolak', //'Tolak By Rental',
            '7' => 'Batal By Rental',
            '8' => 'Pemesan Batal', //'Batal By Pemesan',
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
}
