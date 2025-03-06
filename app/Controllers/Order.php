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
            // echo json_encode($data); die;

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
                'tgl_start' => date('Y-m-d H:i', strtotime($data['tgl_start'] . ' ' . $data['jam_start'])),
                'tgl_finish' => date('Y-m-d H:i', strtotime($data['tgl_finish'] . ' ' . $data['jam_finish'])),
                'lokasi_jemput' => isset($data['lokasi_jemput']) ? $data['lokasi_jemput'] : '',
                'lokasi_tujuan' => isset($data['lokasi_tujuan']) ? $data['lokasi_tujuan'] : '',
                'jarak' => isset($data['jarak']) ? ($data['jarak']) : 1, //40.165 meter
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

            // include
            $include = 'Mobil, Driver, ';
            if($data['is_bbm']) $include .= 'BBM, ';
            if($data['is_makan']) $include .= 'Makan, ';
            if($data['is_hotel']) $include .= 'Hotel, ';
            $include = rtrim($include, ', ');
            $data['include'] = $include;

            // if dalam kota
            if(isset($data['dalam_kota']) && $data['dalam_kota']=='on') $data['jarak'] = 1;

            $curlOpt = array_merge($curlOpt, $data);
            // echo json_encode($curlOpt); die();

            if(empty($listData)) $listData = getCurl($curlOpt, $this->ipAddress . 'search_entry_order_7.php');
            // echo json_encode($listData);
        }

        return view('pages/order/searchorder', [
            'title' => 'Order Pelayanan',
            'jns_order' => 1,
            'listData' => $listData
        ]);
    }

    public function selectOrder()
    {
        // echo $id;
        // $id_order = $_POST['id_order'];
        // select_detail_order_1.php
        $listData = [];

        $curlOpt    = [
            // 'caller' => 'MASTER',
            'kd_member' => $this->session->get('user')['kode'],
        ];

        // handle POST
        if($this->request->getMethod() == 'POST') {
            $data = $this->request->getPost();
            /** Form Input Data Order
             *  - Jenis Transmisi
             *  - Warna Unit
             *  - Jml Order Unit
             *  - Data Pelanggan (sesuai dgn jml unit)
             *  - Jenis Bayar (1: lunas, 2: DP, 3: mundur)
             *  - Catatan
             *  - Voucher
             */
            
            if(isset($data['form_step']) && $data['form_step'] == '2') {
                
                $decoded = rawurldecode($data['item']);
                $array_data = json_decode($decoded, true);
                // $resp = json_encode($array_data);
                $array_data['jns_order'] = $data['jns_order'] ?? 1;
                $array_data['tempo_bayar'] = $data['tempo_bayar'] ?? 0;

                // Parsing ulang bagian "item" yang masih dalam format JSON string
                $respItem = json_decode($array_data['item'], true);
                // $respItem = json_encode($respItem);
                
                // list_plgn
                for ($i = 0; $i < ($array_data['jumlah']); $i++) {
                    $jsonString['values'][] = [
                        'no' => ($i+1),
                        'nama' => $array_data['nama'][$i],
                        'nohp' => $array_data['no_hp'][$i],
                        'nik' => $array_data['nik'][$i],
                        'note' => $array_data['note'][$i]
                    ];
                }

                $respItemArr = [
                    'kd_rental' => $respItem['koderental'],
                    'kd_unit' => $respItem['kode'],
                    'hrg_unit' => $respItem['hrg_unit'],
                    'hrg_sewa' => $respItem['hrg_sewa'],
                    'tgl_start' => $respItem['tgl_start'],
                    'tgl_finish' => $respItem['tgl_finish'],
                    'jemput' => $respItem['lokasi_jemput'],
                    'tujuan' => $respItem['lokasi_tujuan'],
                    'ketr' => $respItem['ketr'],
                    'jns_order' => (string)$array_data['jns_order'],
                    'jml_order' => $array_data['jumlah'],
                    'transmisi' => $array_data['jenis_transmisi'],
                    'warna' => $array_data['warna'],
                    'hrg_sewa_total' => $respItem['total_hrg_sewa'],
                    'jns_bayar' => (string)$array_data['jenis_pembayaran'],
                    'tempo_bayar' => $array_data['tempo_bayar'],
                    'catatan_bayar' => $array_data['catatan'],
                    'voucher' => substr($array_data['voucher'], 0, 10), //limit 10 karakter
                    'list_plgn' => json_encode($jsonString),
                ];
                // echo json_encode($respItemArr); die();

                $curlOpt = array_merge($curlOpt, $respItemArr);
                // echo json_encode($curlOpt); die();

                if(empty($listData)) $listData = getCurl($curlOpt, $this->ipAddress . 'submit_order_2b.php');
                
                if($listData['success'] == '1') {
                    // redirect to home
                    return redirect()->to('/')->with('success', 'Order berhasil dibuat');
                } else {
                    // show error
                    return redirect()->to('order/orderlayanan')->with('error', $listData['message'] . ' ' . $listData['error']);
                }
            
            } else {

                echo json_encode($data); //{"kode":"23050001AV0001","jenis_transmisi":"Manual","warna":"Hitam","jumlah":"1","nama":"Galih Pratama","no_hp":"0876543210","nik":"1234567","note":"ini note","jenis_pembayaran":"1","catatan":"ini catatan","voucher":"ini voucher"}
                
            }

        }
    }

    public function lepasKunci() 
    {    
        // echo 'Lepas Kunci';
        $view_page = 'pages/order/lepaskunci';
        $jns_order = 2;

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
                'jns_order' => isset($data['jns_order']) ? $data['jns_order'] : $jns_order,
                'kd_member' => $this->session->get('user')['kode'],
                'kd_kota' => $data['kd_kota'],
                'search' => '%' . $data['search'] . '%',
                'tgl_start' => date('Y-m-d H:i', strtotime($data['tgl_start'] . ' ' . $data['jam_start'])),
                'tgl_finish' => date('Y-m-d H:i', strtotime($data['tgl_finish'] . ' ' . $data['jam_finish'])),
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
            'jns_order' => $jns_order,
            'listData' => $listData,
            'listKota' => $listKota,
            'listUnit' => $listUnit
        ]);
    }

    public function orderBulanan()
    {
        // echo 'Order Bulanan';
        $view_page = 'pages/order/orderbulanan';
        $jns_order = 4;

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
                'jns_order' => isset($data['jns_order']) ? $data['jns_order'] : $jns_order,
                'kd_member' => $this->session->get('user')['kode'],
                'kd_kota' => $data['kd_kota'],
                'search' => '%' . $data['search'] . '%',
                'tgl_start' => date('Y-m-d H:i', strtotime($data['tgl_start'] . ' ' . $data['jam_start'])),
                // 'tgl_finish' => date('Y-m-d H:i', strtotime($data['tgl_finish'] . ' ' . $data['jam_finish'])),
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

            // jika jns_order = 4
            if($jns_order == 4) {
                $data['tgl_finish'] = date('Y-m-d 23:59', strtotime($data['tgl_start'] . ' + ' . $data['jml_bln'] . ' month'));
                $data['ketr'] = 'Mobil Bulanan';
            }

            // echo json_encode($data); //die();
            $curlOpt = array_merge($curlOpt, $data);
            // echo json_encode($curlOpt); die();

            if(empty($listData)) $listData = getCurl($curlOpt, $this->ipAddress . 'search_entry_order_7.php');
            // echo json_encode($listData); die();

            $view_page = 'pages/order/searchorder';
        }

        if(empty($listKota)) $listKota = getCurl($curlOpt, $this->ipAddress . 'select_kota_1.php');

        return view($view_page, [
            'title' => 'Order Bulanan',
            'jns_order' => $jns_order,
            'listData' => $listData,
            'listKota' => $listKota
        ]);
    }

    public function detailOrder($id)
    {
        // echo 'Detail Order ' . $id;

        $curlOpt = [
            'kd_member' => $this->session->get('user')['kode'],
            'id_order' => $id
        ];

        if(empty($listData)) $listData = getCurl($curlOpt, $this->ipAddress . 'select_detail_order_1.php');
        echo json_encode($listData);
    }

}
