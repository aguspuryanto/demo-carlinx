<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Rate extends BaseController
{
    protected $appId = 'JzYGTa7wXt8X4PAfHFgJ';
    protected $appKey = 'Cikgr94iiQ3Z3EwJG43WSoYhgBpyVw3XtHrI-CsM0Is';
    protected $apiUrl = 'https://autocomplete.search.hereapi.com/v1';

    //https://api.geoapify.com/v1/geocode/autocomplete?text=Mosco&apiKey=b13dfbfe7b934de88fdf373de1f1c1c9
    protected $geoapify = 'b13dfbfe7b934de88fdf373de1f1c1c9'; 
    protected $geoapifyUrl = 'https://api.geoapify.com/v1/geocod';
        
    protected $helpers = ['url', 'form', 'my'];

    public function index()
    {
        // helper('my');
        return view('pages/rate/hitung');
    }

    public function orderlayanan()
    {
        return view('pages/rate/hitung');
    }

    public function lepaskunci() 
    {    
        return view('pages/rate/hitung');
    }

    public function hitung()
    {
        return view('pages/rate/hitung');
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
        } catch (GuzzleHttp\Exception\BadResponseException $e) {
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
