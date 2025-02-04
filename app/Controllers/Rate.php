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
            // echo json_encode($data);

        }

        if(empty($listUnit)) $listUnit = getCurl($curlOpt, $this->ipAddress . 'select_unit_1.php');
        // echo json_encode($listUnit);

        return view('pages/rate/hitung', [
            'title' => 'Hitung Tarif',
            'listUnit' => $listUnit
        ]);
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
            // echo json_encode($data); die();

            // Process origins only if the array is not empty and contains non-empty string
            if (!empty($data['origins']) && is_array($data['origins']) && isset($data['origins'][0]) && !empty(trim($data['origins'][0]))) {
                // Gunakan explode() untuk memisahkan berdasarkan "Indonesia"
                $result = explode("Indonesia", $data['origins'][0]);
                // Hapus elemen kosong yang mungkin muncul akibat pemisahan
                $result = array_filter($result, fn($value) => trim($value) !== "");
                // Reset indeks array agar dimulai dari 0
                $result = array_values($result);
                $result = array_map(fn($value) => trim($value, ", "), $result);

                if (!empty($result[0])) {
                    $data['lokasi_jemput'] = "Indonesia, " . $result[0];
                }
            }

            $data = [
                'jns_order' => 1,
                'kd_unit' => $data['kd_unit'],
                'tgl_start' => date('Y-m-d H:i:s', strtotime($data['tgl_start'] . ' ' . $data['jam_start'])), //$data['tgl_start'] . ' ' . $data['jam_start'],
                'tgl_finish' => date('Y-m-d H:i:s', strtotime($data['tgl_finish'] . ' ' . $data['jam_end'])), //$data['tgl_finish'] . ' ' . $data['jam_end'],
                'lokasi_jemput' => !empty($data['lokasi_jemput']) ? $data['lokasi_jemput'] : null,
                'lokasi_tujuan' => !empty($data['lokasi_tujuan']) ? $data['lokasi_tujuan'] : null,
                'jarak' => ($data['jarak']) ? format_km($data['jarak']) : 1,
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

            if(isset($data['dalam_kota']) && $data['dalam_kota']=='on') {
                $data['jarak'] = 1;
            }

            $curlOpt = array_merge($curlOpt, $data);
            // echo json_encode($curlOpt); die();

            if(empty($listData)) $listData = getCurl($curlOpt, $this->ipAddress . 'search_entry_order_tunggal_4.php');

            if($listData['success'] == 1) {
                // include
                $include = 'Mobil, Driver, ';
                if($data['is_bbm']) $include .= 'BBM, ';
                if($data['is_makan']) $include .= 'Makan, ';
                if($data['is_hotel']) $include .= 'Hotel, ';
                if($data['drop_awal']) $include .= 'Drop Awal, ';
                if($data['drop_akhir']) $include .= 'Drop Akhir, ';
                $include = rtrim($include, ', ');
                $listData['result_unit_order'][0]['include'] = $include;
                
                // set data pelanggan
                $listData['result_unit_order'][0]['nama_pelanggan'] = $this->session->get('user')['nama'];
                $listData['result_unit_order'][0]['no_hp'] = $this->session->get('user')['username'];
            }

            echo json_encode($listData);
        }

        // return view('pages/rate/hitung');
    }

    public function sendWhatsapp()
    {
        $data = $this->request->getPost();
        // echo json_encode($data); die(); // {tgl_start: '2025-01-20 11:43:00', jam_start: '', tgl_finish: '2025-01-21 11:43:00', jam_end: '', lokasi_tujuan: 'Indonesia, Gresik, Jalan Raya Putat Lor', …}
        if($data['nama_pelanggan'] == '' || $data['no_hp'] == '') {
            echo json_encode(['success' => 0, 'message' => 'Nama pelanggan atau no hp tidak boleh kosong']);
            return;
        } else {
            // include
            $include = 'Mobil, Driver';
            if($data['include']) $include = $data['include'];

            $phone = '0818336745';//$data['no_hp'];
            // remove 0 at first of phone, then replace +62
            $phone = ltrim($phone, '0');
            $phone = '+62' . $phone;

            $message = 'Yth. Bpk/Ibu ' . $data['nama_pelanggan'] . ',
Berikut kami sampaikan penawaran harga sewa mobil yang Bpk/Ibu butuhkan: 

Tanggal : ' . date('d-m-Y H:i', strtotime($data['tgl_start'])) . ' s/d ' . date('d-m-Y H:i', strtotime($data['tgl_finish'])) . '

Tujuan : ' . str_replace('Indonesia, ', '', $data['lokasi_jemput']) . ' - ' . str_replace('Indonesia, ', '', $data['lokasi_tujuan']) . '

Mobil ' . $data['nama_unit'] . '

Include : ' . $data['include'] . '

Harga : Rp. ' . format_rupiah($data['total_hrg_sewa']) . '
Total : Rp. ' . format_rupiah($data['total_hrg_sewa']) . '

Pelayanan pertanggal dimulai pukul 06.00-23.00 (mobil sdh ada di garasi)

Best Regard,
Foxie';

            $url = sendWhatsapp($phone, ($message), 'wa');
            echo json_encode(['success' => 1, 'message' => $message, 'url' => $url]);

            // $url = sendWhatsapp($phone, $message);
            // echo $url;
        }
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
