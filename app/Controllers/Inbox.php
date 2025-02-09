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
        // echo json_encode($this->session->get('user'));

        $listData   = [];
        $listUser   = [];
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

        $dataLogin = [
            'usernm' => $this->session->get('user')['username'],
            'passwd' => $this->session->get('user')['password']
        ];
        // if(empty($listUser)) $listUser = getCurl($dataLogin, $this->ipAddress . 'login_user.php');
        if(empty($listUser)) $listUser = ($this->session->get('user'));
        // echo json_encode($listUser); die();

        if(empty($listData)) $listData = getCurl($curlOpt, $this->ipAddress . 'select_order_5.php');
        $listData = json_decode('{"success":1,"result_list_order":[{"id_order":"250209000001","kd_member":"ADM00001","kode_rental":"23050001","kd_unit":"23050001AV0001","hrg_sewa":"650000","tgl_start":"2025-02-09 06:00:00","tgl_finish":"2025-02-09 23:59:00","jemput":"Indonesia, 60261, Surabaya","tujuan":"Indonesia, 65119, Malang Kota","ketr":"","nama_penyewa":null,"ktp_penyewa":null,"hp_penyewa":null,"nopol":null,"nama_driver":null,"hp_driver":null,"tgl_order":"2025-02-09 17:05:32","stat":"1","nama_unit":"AVANZA XL (DEV)","rating":"0.0","note":"","jns_order":"1","norek_rental":"BANK JATIM001.1234.5678a/n MCorner Jaya Sejati","nominal_dp":"0","path_foto":null,"alasan_batal":null,"jml_order":"1","tahun":"","bbm":"Pertalite","transmisi":"Manual","warna":"Silver","jns_byr":"1","tgl_tempo":"2025-02-09","hrg_sewa_total":650000,"sisa_byr":"0","biaya_1":"0","biaya_2":"0","biaya_3":"0","note_driver":null,"tg_jwb":"0","nama_cs":null,"foto_serah":"","foto_terima":"","grp_penyewa":"1","jml_bln":"1","rental_penyewa":"GASIK TRANSX","rental_tujuan":"MCORNER SMS","nominal_disc":"0","ketr_byr":"","nama_member":"Foxie","liq_tujuan":"2","liq":"1","tempo_bayar":"0","catatan_byr":"ini catatan","voucher":"VCH10"}]}', true);
        
        if ($listData === null) {
            // Handle JSON decode error
            echo "Error decoding JSON";
            die();
        }
        
        $newlistData = [];
        if ($listData['success'] == '1') {
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
            'listData' => $listData,
            'listUser' => $listUser
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
