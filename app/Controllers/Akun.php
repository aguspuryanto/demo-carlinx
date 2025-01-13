<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use GuzzleHttp\Client;

class Akun extends BaseController
{
    protected $ipAddress;

    public function __construct()
    {
        helper('my');
        $this->ipAddress = $_ENV['API_BASEURL'];
    }

    public function index()
    {
        $userList = [];
        $cityList = [];

        // $client = new Client();
        // $response = $client->request('POST', $this->ipAddress . 'select_user.php', [
        //     'form_params' => [
        //         'usernm' => '0876543210'
        //     ]
        // ]);
        // $data = json_decode($response->getBody()->getContents(), true);

        if(empty($userList)) $client = getCurl(['usernm' => '0876543210'], $this->ipAddress . 'select_user.php');
        // echo json_encode($client);
        if($client['success']){
            $userList = $client['result'];
        }

        if(empty($cityList)) $cityList = getCurl([], $this->ipAddress . 'select_kota_1.php');
        // echo json_encode($cityList);
        if($cityList['success']){
            $cityList = $cityList['result_kota'];
        }

        return view('akun/index', [
            'title' => 'Akun',
            'userList' => $userList,
            'cityList' => $cityList
        ]);
    }

    public function update()
    {
        //get data from form post
        $req = $this->request->getPost();
        // echo json_encode($req); //{"usernm":"+62876543210","nama":"Foxie","nama_pt":"GASIK TRANSX","jabatan":"0","ijin_pt":"123.456.789.00","norek":"BCA 001.1234.5678a\/n Gemilang Kreasi Kami","alamat":"Tenggilis Mejoyo","kota":"KOTA SURABAYA","email":"april_id2000@yahoo.com","hp_perush":"+62818336745","hp_cs":"+6281131183229","is_layanan":"on","is_bulanan":"on","is_lepaskunci":"on"}

        // $nohp_0 = $_POST['usernm'];
        // $nama = $_POST['nama'];
        // $kd_kota = $_POST['kd_kota'];
        // $nama_perush = $_POST['nm_perush'];
        // $alamat_perush = $_POST['alamat'];
        // $ijin_perush = $_POST['ijin_perush'];
        // $norek = $_POST['norek'];
        // $email = $_POST['email_addr'];
        // $layanan = $_POST['layanan'];
        // $event = $_POST['event'];
        // $bulanan = $_POST['bulanan'];
        // $lepaskunci = $_POST['lepaskunci'];
        // $publish = $_POST['publish'];
        // $hp_perush_0 = $_POST['hp_perush'];

        $curlOptions = [
            'usernm' => $req['usernm'],
            'nama' => $req['nama'],
            'kd_kota' => $req['kd_kota'],
            'nm_perush' => $req['nama_pt'],
            'alamat' => $req['alamat'],
            'ijin_perush' => $req['ijin_pt'],
            'norek' => $req['norek'],
            'email_addr' => $req['email'],
            'layanan' => $req['is_layanan'],
            'event' => $req['is_bulanan'],
            'bulanan' => $req['is_bulanan'],
            'lepaskunci' => $req['is_lepaskunci'],
            'publish' => $req['is_publish'],
            'hp_perush' => $req['hp_perush'],
        ];

        $client = getCurl($curlOptions, $this->ipAddress . 'update_user_1.php');
        // echo json_encode($client);
        
        if($client['success']){
            return redirect()->back()->with('success', 'Data berhasil diubah');
        }
    }

    public function edit($id)
    {
        //
    }
}
