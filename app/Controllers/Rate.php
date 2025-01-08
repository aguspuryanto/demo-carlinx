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
        // helper('my');
        return view('pages/rate/hitung');
    }

    public function orderLayanan()
    {
        return view('pages/order/orderlayanan', ['title' => 'Order Layanan']);
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
        return view('pages/rate/hitung');
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
