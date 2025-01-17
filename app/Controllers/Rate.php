<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Rate extends BaseController
{
    protected $appId = 'JzYGTa7wXt8X4PAfHFgJ';
    protected $appKey = 'Cikgr94iiQ3Z3EwJG43WSoYhgBpyVw3XtHrI-CsM0Is';
    protected $apiUrl = 'https://autocomplete.search.hereapi.com/v1';

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

        $this->appKey = $_ENV['API_KEY_HERE'];
        $this->apiUrl = $_ENV['API_BASEURL_HERE'];
    }

    public function index()
    {

        $listData = [];
        $listUnit = [];

        $curlOpt    = [
            // 'caller' => 'MASTER',
            'kd_member' => $this->session->get('user')['kode'],
            // 'kd_kota' => NULL
        ];

        // handle POST
        if ($this->request->getMethod() == 'POST') {
            $data = $this->request->getPost();
            echo json_encode($data);

        }

        if(empty($listUnit)) $listUnit = getCurl($curlOpt, $this->ipAddress . 'select_unit_1.php');

        return view('pages/rate/hitung', [
            'title' => 'PenawaranQ',
            'listUnit' => $listUnit
        ]);
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

    public function lepasKunci() 
    {    
        return view('pages/rate/hitung', ['title' => 'Lepaskunci']);
    }

    public function orderBulanan()
    {
        return view('pages/order/orderbulanan', ['title' => 'Order Bulanan']);
    }

    public function hitung()
    {
        $listData = [];
        $curlOpt    = [
            // 'caller' => 'MASTER',
            'kd_member' => $this->session->get('user')['kode'],
            // 'kd_kota' => NULL
        ];
        
        // handle POST
        if ($this->request->getMethod() == 'POST') {
            $data = $this->request->getPost();
            // echo json_encode($data); //{"kd_unit":"22040001AV0002","tgl_start":"19-01-2025","jam_start":"00:00","tgl_finish":"22-01-2025","jam_end":"00:00","lokasi_jemput":"here:af:street:Ytv1uykHYZJR7q1RySCNhB","lokasi_tujuan":"here:af:street:CoYF2Nk.rFCjgz.qUMWNxC","is_bbm":"on","is_makan":"on","is_hotel":"on","drop_awal":"on","drop_akhir":"on","tolparkir":"80000","lainlain":"130000","jarak":"","ketr":"","fee":""}

            /*$jns_order = $_POST['jns_order'];
            $kd_member = $_POST['kd_member'];
            $kd_unit = $_POST['kd_unit'];
            $tgl_1 = $_POST['tgl_start']; // format datetime
            $tgl_2 = $_POST['tgl_finish']; // format datetime
            $lokasi_jemput = $_POST['lokasi_jemput'];
            $lokasi_tujuan = $_POST['lokasi_tujuan'];
            $jarak_tempuh = $_POST['jarak'];
            $is_bbm = $_POST['is_bbm'];
            $is_makan = $_POST['is_makan'];
            $is_hotel = $_POST['is_hotel'];
            $ketr = $_POST['ketr'];
            //$fee = $_POST['fee'];
            $tolparkir = $_POST['tolparkir'];
            $lainlain = $_POST['lainlain'];
            $drop_awal = $_POST['drop_awal'];
            $drop_akhir = $_POST['drop_akhir'];*/

            // lakukan validasi data
            // $validation =  \Config\Services::validation();
            // $validation->setRules([
            //     'nama' => 'required',
            //     'nohp' => 'required',
            // ]);
            // $isDataValid = $validation->withRequest($this->request)->run();

            // // jika data valid, maka submit
            // if($isDataValid){

                $data = [
                    'jns_order' => 1,
                    'kd_unit' => $data['kd_unit'],
                    'tgl_start' => date('Y-m-d H:i:s', strtotime($data['tgl_start'] . ' ' . $data['jam_start'])), //$data['tgl_start'] . ' ' . $data['jam_start'],
                    'tgl_finish' => date('Y-m-d H:i:s', strtotime($data['tgl_finish'] . ' ' . $data['jam_end'])), //$data['tgl_finish'] . ' ' . $data['jam_end'],
                    'lokasi_jemput' => $data['lokasi_jemput'],
                    'lokasi_tujuan' => $data['lokasi_tujuan'],
                    'jarak_tempuh' => ($data['jarak']) ? $data['jarak'] : 0,
                    'is_bbm' => isset($data['is_bbm']) ? 1 : 0,
                    'is_makan' => isset($data['is_makan']) ? 1 : 0,
                    'is_hotel' => isset($data['is_hotel']) ? 1 : 0,
                    'ketr' => $data['ketr'],
                    'fee' => $data['fee'],
                    'tolparkir' => ($data['tolparkir']) ? $data['tolparkir'] : 0,
                    'lainlain' => ($data['lainlain']) ? $data['lainlain'] : 0,
                    'drop_awal' => isset($data['drop_awal']) ? 1 : 0,
                    'drop_akhir' => isset($data['drop_akhir']) ? 1 : 0,
                ];
    
                $curlOpt = array_merge($curlOpt, $data);
                // echo json_encode($curlOpt); die();
    
                if(empty($listData)) $listData = getCurl($curlOpt, $this->ipAddress . 'search_entry_order_tunggal_4.php');
    
                echo json_encode($listData); //{"success":1,"result_unit_order":[{"koderental":"22040001","kode":"22040001AV0002","nama":"AVANZA 2017 (TES)","path_foto":"22040001AV0002.jpg","hrg_sewa":"537500","tgl_start":"2025-01-19 00:00:00","tgl_finish":"2025-01-22 00:00:00","lokasi_jemput":"here:af:street:Ytv1uykHYZJR7q1RySCNhB","lokasi_tujuan":"here:af:street:CoYF2Nk.rFCjgz.qUMWNxC","ketr":"","hrg_unit":"225000","rating":"5.0","terjual":"51","total_hrg_sewa":"2375000"}]}
                
            // } else {
            //     // $error['error'] = $validation->getErrors();
            //     $this->session->setFlashdata('error', 'Data tidak valid');
            // }
        }

        // return view('pages/rate/hitung');
    }

    public function getUnit() 
    {
        /* params: 
         * caller optional
         * kd_member required
         * kd_kota required
         * search required
         */

        $listData   = [];
        $curlOpt    = [
            'caller' => 'MASTER',
            'kd_member' => $this->session->get('user')['kode'],
            'kd_kota' => ''
            // 'search' => $this->request->getGet('q')
        ];
        // echo json_encode($curlOpt);

        if(empty($listData)) $listData = getCurl($curlOpt, $this->ipAddress . 'select_unit.php');

        if($this->request->getget('q')) {
            // echo json_encode($listData);
            $search = $this->request->getGet('q');
            $listData = array_filter($listData['result_unit'], function($item) use ($search) {
                return strpos($item['nama'], $search) !== false;
            });
            echo json_encode($listData);
        }

        echo json_encode($listData);

    }

    public function placeid()
    {
        //Create guzzle http client
        $client = new \GuzzleHttp\Client();

        $options = [
            'q' => $this->request->getGet('term'),
            'in' => 'countryCode:IDN',
            'apikey' => $this->appKey
        ];

        try {
            $response = $client->request('GET', $this->apiUrl . '/autocomplete?' . http_build_query($options));
            echo $response->getBody();
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            print_r($responseBodyAsString);
        }
    }

    function hitungJarakQuery()
    {
        $distance = 50; // user input distance
        $user_latitude = '26.826999'; // user input latitude
        $user_longitude = '-158.265114'; // user input logtitude

        // $sql = "SELECT ROUND(6371 * acos (cos ( radians($user_latitude) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians($user_longitude) ) + sin ( radians($user_latitude) ) * sin( radians( latitude ) ))) AS distance,geo_cord.* FROM geo_cord HAVING distance <= $distance";
    }

    function distance($latitude1, $longitude1, $latitude2, $longitude2) { 
        $pi80 = M_PI / 180; 
        $lat1 *= $pi80; 
        $lon1 *= $pi80; 
        $lat2 *= $pi80; 
        $lon2 *= $pi80; 
        $r = 6372.797; // radius of Earth in km 6371
        $dlat = $lat2 - $lat1; 
        $dlon = $lon2 - $lon1; 
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2); 
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a)); 
        $km = $r * $c; 
        return round($km); 
    }

}
