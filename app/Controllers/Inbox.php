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

        $listStatus = [];
        $listStatus_pemesan = [
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

        $listStatus_rental = [
            '1' => 'Order Baru',
            '4' => 'Menunggu',
            '5' => 'Tunggu Pembayaran',
            '6' => 'Ditolak',
            '7' => 'Rental Batal',
            '8' => 'Pemesan Batal',
            '9' => 'Selesai'
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
            
            $is_vendor = ($listData['result_list_order'][0]['kode_rental'] == $listUser['kd_rental']) ? true : false;
            $is_pemesan = ($listData['result_list_order'][0]['kode_rental'] != $listUser['kd_rental']) ? true : false;

            if($is_vendor) $listStatus = $listStatus_rental;
            if($is_pemesan) $listStatus = $listStatus_pemesan;
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
        $listData = [];

        // handle POST
        if ($this->request->getMethod() == 'POST') {
            $data = $this->request->getPost();
            // echo json_encode($data); die(); //{"id_order":"250218000007","stat_ori":"1","stat":"1","is_vendor":"1","is_pemesan":"","nama_plgn":"Test (8765432)","no_hp":"8765432","ktp_plgn":"12345","note":"","nama_driver":["TEST DRIVER"],"no_hp_driver":["08271615"],"nopol_driver":["L 2345 WE"],"note_driver":["test terima"],"action":"terima"}

            /* Sisi Pemesan
            - stat = 1 : batal (stat: 8)
            - stat = 4 :
            * Batal : update stat = 8
            * Submit : update stat = 5

            Sisi Rental
            - stat = 1 : terima (stat: 4), tolak (stat: 6)
            - stat = 5 :
            * Batal : update stat = 7
            * pembayaran diterima  
            * Submit : update stat = 9
            */

            if($data['is_pemesan'] == '1'){
                if($data['stat_ori'] == '1' && $data['action'] == 'batal'){
                    $data['stat'] = '8'; // batal
                }
                if($data['stat_ori'] == '4'){
                    if($data['action'] == 'batal'){
                        $data['stat'] = '8'; // batal
                    }
                    if($data['action'] == 'terima'){
                        $data['stat'] = '5'; // submit
                    }
                }
            }

            if($data['is_vendor'] == '1'){
                if($data['stat_ori'] == '1'){
                    if($data['action'] == 'tolak'){
                        $data['stat'] = '6'; // tolak
                    }
                    if($data['action'] == 'terima'){
                        $data['stat'] = '4'; // terima  
                    }
                }
                if($data['stat_ori'] == '5'){
                    if($data['action'] == 'batal'){
                        $data['stat'] = '7'; // batal
                    }
                    if($data['action'] == 'terima'){
                        $data['stat'] = '9'; // submit
                    }
                }                
            }

            // update_order_1a.php
            $curlOpt    = [
                'caller' => 'STAT', // default. INBOX, AKTIF, RIWAYAT
                'kd_member' => $this->session->get('user')['kode'],
                'id_order' => $data['id_order'],
                'stat_ori' => $data['stat_ori'],
                'stat' => $data['stat'], //batal
                'alasan_batal' => '-'
            ];

            $listData   = getCurl($curlOpt, $this->ipAddress . 'update_order_1a.php');
            // echo json_encode($listData); die();

            if($data['is_vendor'] == '1'){
                // update driver
                $countDrv = count($data['nama_driver']);
                for($i=0; $i<$countDrv; $i++){
                    $curlOptDrv    = [
                        'id_order' => $data['id_order'],
                        'no' => ($i+1),
                        'nama' => $data['nama_driver'][$i],
                        'nohp' => $data['no_hp_driver'][$i],
                        'nopol' => $data['nopol_driver'][$i],
                        'note' => $data['note_driver'][$i]
                    ];
                    // echo json_encode($curlOptDrv); //die(); //{"id_order":"250218000007","no":["08271615"],"nama":["TEST DRIVER"],"nohp":["08271615"],"nopol":["L 2345 WE"],"note":["test terima"]}

                    $updtDrv   = getCurl($curlOptDrv, $this->ipAddress . 'update_single_drv.php');
                    // echo json_encode($updtDrv); die();
                    $listData = array_merge($listData, $updtDrv);
                    // echo json_encode($updtDrv); die();
                }
            }
            
            $response = [
                'success' => ($listData['success']=='1') ? true : false,
                'message' => $listData['message']
            ];

            echo json_encode($response);

            // return redirect()->to(base_url('inbox'))->with('success', 'Order confirmed successfully');
        }
    }

    public function ubahPayment()
    {
        $data = $this->request->getPost();
        echo json_encode($data); die();
    }
}
