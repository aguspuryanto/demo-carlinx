<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Order extends BaseController
{
    protected $ipAddress;
    protected $session;
        
    protected $helpers = ['url', 'form', 'my'];

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
    }

    public function orderLayanan()
    {
        /*search_entry_order_7.php (jns_order: 1)
        select_unit_1.php
        select_unit_by_name_1.php
        submit_order_2a.php
        update_order_1.php
        update_order_closed_1.php
        search_order_2.php
        select_detail_order_1.php
        upload_bukti_dp_1.php
        update_array_plgn_1.php
        update_single_plgn_1.php
        update_array_drv_1.php
        update_single_drv.php
        update_pembayaran_2.php*/

        $listKota   = [];
        $curlOpt    = [
            // 'caller' => 'MASTER',
            'kd_member' => $this->session->get('user')['kode'],
        ];

        // handle POST
        if ($this->request->getMethod() == 'POST') {
            $data = $this->request->getPost();
            // echo json_encode($data);

            // $jns_order = $_POST['jns_order'];
            // $kd_member = $_POST['kd_member'];
            // $kd_kota = $_POST['kd_kota'];
            // $search = $_POST['search'];
            // $tgl_1 = $_POST['tgl_start'];
            // $tgl_2 = $_POST['tgl_finish'];
            // $lokasi_jemput = $_POST['lokasi_jemput'];
            // $lokasi_tujuan = $_POST['lokasi_tujuan'];
            // $jarak_tempuh = $_POST['jarak'];
            // $is_bbm = $_POST['is_bbm'];
            // $is_makan = $_POST['is_makan'];
            // $is_hotel = $_POST['is_hotel'];
            // $ketr = $_POST['ketr'];
            // $is_antar = $_POST['is_antar'];
            // $is_ambil = $_POST['is_ambil'];
            // $drop_awal = $_POST['drop_awal'];
            // $drop_akhir = $_POST['drop_akhir'];
            // $tg_jwb = $_POST['tg_jwb'];
            // $jml_bln = $_POST['jml_bln'];
        }

        if(empty($listKota)) $listKota = getCurl($curlOpt, $this->ipAddress . 'select_kota_1.php');

        return view('pages/order/orderlayanan', [
            'title' => 'Order Layanan',
            'listKota' => $listKota
        ]);
    }

    public function searchOrder()
    {
        // echo 'Search Order';
        $listData = [];

        $curlOpt    = [
            // 'caller' => 'MASTER',
            'kd_member' => $this->session->get('user')['kode'],
        ];

        // handle POST
        if ($this->request->getMethod() == 'POST') {
            $data = $this->request->getPost();
            // echo json_encode($data);

            /**
             * $jns_order = $_POST['jns_order'];
             * $kd_member = $_POST['kd_member'];
             * $kd_kota = $_POST['kd_kota'];
             * $search = $_POST['search'];
             * $tgl_1 = $_POST['tgl_start'];
             * $tgl_2 = $_POST['tgl_finish'];
             * $lokasi_jemput = $_POST['lokasi_jemput'];
             * $lokasi_tujuan = $_POST['lokasi_tujuan'];
             * $jarak_tempuh = $_POST['jarak'];
             * $is_bbm = $_POST['is_bbm'];
             * $is_makan = $_POST['is_makan'];
             * $is_hotel = $_POST['is_hotel'];
             * $ketr = $_POST['ketr'];
             * $is_antar = $_POST['is_antar'];
             * $is_ambil = $_POST['is_ambil'];
             * $drop_awal = $_POST['drop_awal'];
             * $drop_akhir = $_POST['drop_akhir'];
             * $tg_jwb = $_POST['tg_jwb'];
             * $jml_bln = $_POST['jml_bln'];
             */

            $data = [
                'jns_order' => isset($data['jns_order']) ? $data['jns_order'] : 1,
                'kd_member' => $this->session->get('user')['kode'],
                'kd_kota' => $data['kd_kota'],
                'search' => '%' . $data['search'] . '%',
                'tgl_1' => $data['tgl_start'],
                'tgl_2' => $data['tgl_finish'],
                'lokasi_jemput' => isset($data['lokasi_jemput']) ? $data['lokasi_jemput'] : '',
                'lokasi_tujuan' => isset($data['lokasi_tujuan']) ? $data['lokasi_tujuan'] : '',
                'jarak' => isset($data['jarak']) ? ($data['jarak']) : 0, //40.165 meter
                'is_bbm' => isset($data['is_bbm']) ? 1 : 0,
                'is_makan' => isset($data['is_makan']) ? 1 : 0,
                'is_hotel' => isset($data['is_hotel']) ? 1 : 0,
                'ketr' => isset($data['ketr']) ? $data['ketr'] : '',
                'is_antar' => isset($data['is_antar']) ? 1 : 0,
                'is_ambil' => isset($data['is_ambil']) ? 1 : 0,
                'drop_awal' => isset($data['drop_awal']) ? 1 : 0,
                'drop_akhir' => isset($data['drop_akhir']) ? 1 : 0,
                'tg_jwb' => isset($data['tg_jwb']) ? $data['tg_jwb'] : '',
                'jml_bln' => isset($data['jml_bln']) ? $data['jml_bln'] : 0
            ];

            // echo json_encode($data);

            $curlOpt = array_merge($curlOpt, $data);
            if(empty($listData)) $listData = getCurl($curlOpt, $this->ipAddress . 'search_entry_order_7.php');
            // echo json_encode($listData);
        }

        return view('pages/order/searchorder', [
            'title' => 'Order Pelayanan',
            'jns_order' => 1,
            'listData' => $listData
        ]);
    }

    public function selectOrder($id)
    {
        // echo $id;
        // $id_order = $_POST['id_order'];
        // select_detail_order_1.php
        $listData = [];

        $curlOpt = [
            'id_order' => $id
        ];

        // $caller = $_POST['caller'];
        // $kd_member = $_POST['kd_member'];
        // $kd_kota = $_POST['kd_kota'];
        // select_unit_1.php

        // $caller = $_POST['caller'];
        // $kd_member = $_POST['kd_member'];
        // $kd_kota = $_POST['kd_kota'];
        // $search = $_POST['search'];
        // select_unit_by_name_1.php

        // $listData = getCurl($curlOpt, $this->ipAddress . 'select_detail_order_1.php');
        // echo json_encode($listData);

        return view('pages/order/selectorder', [
            'title' => 'Order Pelayanan',
            'listData' => $listData
        ]);
    }

    public function lepasKunci() 
    {    
        // echo 'Lepas Kunci';
        $view_page = 'pages/order/lepaskunci';
        $listData   = [];
        $listKota   = [];
        $listUnit   = [];
        $curlOpt    = [
            'kd_member' => $this->session->get('user')['kode'],
        ];

        // handle POST
        if ($this->request->getMethod() == 'POST') {
            $data = $this->request->getPost();
            // echo json_encode($data); die();

            // search_entry_order_7.php (jns_order: 2)
            $data = [
                'jns_order' => isset($data['jns_order']) ? $data['jns_order'] : 2,
                'kd_member' => $this->session->get('user')['kode'],
                'kd_kota' => $data['kd_kota'],
                'search' => '%' . $data['search'] . '%',
                'tgl_1' => $data['tgl_start'],
                'tgl_2' => $data['tgl_finish'],
                'lokasi_jemput' => isset($data['lokasi_jemput']) ? $data['lokasi_jemput'] : '',
                'lokasi_tujuan' => isset($data['lokasi_tujuan']) ? $data['lokasi_tujuan'] : '',
                'jarak' => isset($data['jarak']) ? format_km($data['jarak']) : 0, //40.165 meter
                'is_bbm' => isset($data['is_bbm']) ? 1 : 0,
                'is_makan' => isset($data['is_makan']) ? 1 : 0,
                'is_hotel' => isset($data['is_hotel']) ? 1 : 0,
                'ketr' => isset($data['ketr']) ? $data['ketr'] : '',
                'is_antar' => isset($data['is_antar']) ? 1 : 0,
                'is_ambil' => isset($data['is_ambil']) ? 1 : 0,
                'drop_awal' => isset($data['drop_awal']) ? 1 : 0,
                'drop_akhir' => isset($data['drop_akhir']) ? 1 : 0,
                'tg_jwb' => isset($data['tg_jwb']) ? $data['tg_jwb'] : '',
                'jml_bln' => isset($data['jml_bln']) ? $data['jml_bln'] : 0
            ];

            // echo json_encode($data);
            $curlOpt1 = array_merge($curlOpt, $data);
            if(empty($listData)) $listData = getCurl($curlOpt1, $this->ipAddress . 'search_entry_order_7.php');
            // echo json_encode($listData);

            $curlOpt2 = array_merge($curlOpt, [
                'caller' => 'MASTER',
                'kd_kota' => $data['kd_kota']
            ]);
            // if(empty($listUnit)) $listUnit = getCurl($curlOpt2, $this->ipAddress . 'select_unit_1.php');
            // echo json_encode($listUnit);

            $curlOpt3 = array_merge($curlOpt, [
                'caller' => 'MASTER', // MASTER, HITUNG
                'kd_kota' => $data['kd_kota'],
                'search' => '%' . $data['search'] . '%'
            ]);
            // if(empty($listUnit)) $listUnit = getCurl($curlOpt3, $this->ipAddress . 'select_unit_by_name_1.php');
            // echo json_encode($listUnit);

            $view_page = 'pages/order/searchorder';
        }

        if(empty($listKota)) $listKota = getCurl($curlOpt, $this->ipAddress . 'select_kota_1.php');

        return view($view_page, [
            'title' => 'Order Lepas Kunci',
            'jns_order' => 2,
            'listData' => $listData,
            'listKota' => $listKota,
            'listUnit' => $listUnit
        ]);
    }

    public function orderBulanan()
    {
        // echo 'Order Bulanan';
        $view_page = 'pages/order/orderbulanan';
        $listData   = [];
        $listKota   = [];
        $curlOpt    = [
            'kd_member' => $this->session->get('user')['kode'],
        ];

        // handle POST
        if ($this->request->getMethod() == 'POST') {
            $data = $this->request->getPost();
            // echo json_encode($data); die();
            $data = [
                'jns_order' => isset($data['jns_order']) ? $data['jns_order'] : 3,
                'kd_member' => $this->session->get('user')['kode'],
                'kd_kota' => $data['kd_kota'],
                'search' => '%' . $data['search'] . '%',
                'tgl_1' => $data['tgl_start'],
                'tgl_2' => $data['tgl_finish'],
                'lokasi_jemput' => isset($data['lokasi_jemput']) ? $data['lokasi_jemput'] : '',
                'lokasi_tujuan' => isset($data['lokasi_tujuan']) ? $data['lokasi_tujuan'] : '',
                'jarak' => isset($data['jarak']) ? format_km($data['jarak']) : 0, //40.165 meter
                'is_bbm' => isset($data['is_bbm']) ? 1 : 0,
                'is_makan' => isset($data['is_makan']) ? 1 : 0,
                'is_hotel' => isset($data['is_hotel']) ? 1 : 0,
                'ketr' => isset($data['ketr']) ? $data['ketr'] : '',
                'is_antar' => isset($data['is_antar']) ? 1 : 0,
                'is_ambil' => isset($data['is_ambil']) ? 1 : 0,
                'drop_awal' => isset($data['drop_awal']) ? 1 : 0,
                'drop_akhir' => isset($data['drop_akhir']) ? 1 : 0,
                'tg_jwb' => isset($data['tg_jwb']) ? $data['tg_jwb'] : '',
                'jml_bln' => isset($data['jml_bln']) ? $data['jml_bln'] : 0
            ];

            // echo json_encode($data); //die();
            $curlOpt = array_merge($curlOpt, $data);
            if(empty($listData)) $listData = getCurl($curlOpt, $this->ipAddress . 'search_entry_order_7.php');
            // echo json_encode($listData); die();

            $view_page = 'pages/order/searchorder';
        }

        if(empty($listKota)) $listKota = getCurl($curlOpt, $this->ipAddress . 'select_kota_1.php');

        return view($view_page, [
            'title' => 'Order Bulanan',
            'listData' => $listData,
            'listKota' => $listKota
        ]);
    }

}
