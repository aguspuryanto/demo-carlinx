<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use GuzzleHttp\Client;
use CodeIgniter\Files\File;


class Akun extends BaseController
{
    protected $ipAddress;
    protected $session;
    protected $helpers = ['form', 'my'];
    protected $destinationUrl = 'http://103.178.174.7/foxrent/upload_profile.php';

    public function __construct()
    {
        // helper('my');
        $this->ipAddress = $_ENV['API_BASEURL'];
        $this->session = session();
        // jika tidak ada session, redirect ke login
        if (!$this->session->get('user') || !isset($this->session->get('user')['kode'])) {
            return redirect()->to('/login');
        }
    }

    public function index()
    {
        $userList = [];
        $cityList = [];

        $usernm = ($this->session->get('user')['username']) ?? '0876543210';
        if(empty($userList)) $client = getCurl(['usernm' => $usernm], $this->ipAddress . 'select_user.php');
        // echo json_encode($client); die();
        if($client['success'] == '1'){
            $userList = $client['result'];
        } else {
            // user not found
            $this->session->destroy();
            return redirect()->to('/login');
        }

        if(empty($cityList)) $cityList = getCurl([], $this->ipAddress . 'select_kota_1.php');
        // echo json_encode($cityList);
        if($cityList['success'] == '1'){
            $cityList = $cityList['result_kota'];
        } else {
            $cityList = [];
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
        // echo json_encode($req); die(); //{"usernm":"+62876543210","nama":"Foxie","nama_pt":"GASIK TRANSX","jabatan":"0","ijin_pt":"123.456.789.00","norek":"BCA 001.1234.5678a\/n Gemilang Kreasi Kami","alamat":"Tenggilis Mejoyo","kota":"KOTA SURABAYA","email":"april_id2000@yahoo.com","hp_perush":"+62818336745","hp_cs":"+6281131183229","is_layanan":"on","is_bulanan":"on","is_lepaskunci":"on"}

        if(empty($req)) {
            // return redirect()->back()->with('error', 'Data tidak boleh kosong');
            $this->session->setFlashdata('error', 'Data tidak valid');
        }

        $curlOptions = [
            'usernm' => $req['usernm'],
            'nama' => $req['nama'],
            'kd_kota' => $req['kd_kota'],
            'nm_perush' => $req['nama_pt'],
            'alamat' => $req['alamat'],
            'ijin_perush' => $req['ijin_pt'],
            'norek' => $req['norek'],
            'email_addr' => $req['email'],
            'layanan' => isset($req['is_layanan']) ? 1 : 0,
            'event' => isset($req['is_event']) ? 1 : 0,
            'bulanan' => isset($req['is_bulanan']) ? 1 : 0,
            'lepaskunci' => isset($req['is_lepaskunci']) ? 1 : 0,
            'publish' => isset($req['is_publish']) ? 1 : 0,
            'hp_perush' => $req['hp_perush']
        ];

        $client = getCurl($curlOptions, $this->ipAddress . 'update_user_1.php');
        // echo json_encode($client);
        
        if($client['success']){
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            $errors = [];
            $kd_site = $this->session->get('user')['kode'];
            // echo print_r($_FILES['uploaded_file']);
            if(isset($_FILES['uploaded_file'])){
                if (isset($_FILES['uploaded_file']) && $_FILES['uploaded_file']['size'] > 0) {
                    $fileName = $kd_site . "_1.jpg";
                    $targetFile = $uploadDir . $fileName;

                    if (!move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $targetFile)) {
                        $errors[] = "Failed to upload file: $fileName. Please check file permissions and try again.";
                    }
                    
                    if (is_file($targetFile)) {
                        $ch = curl_init();

                        $postData = [
                            'uploaded_file' => new \CURLFile($targetFile)
                        ];

                        curl_setopt($ch, CURLOPT_URL, $this->destinationUrl);
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                        $response = curl_exec($ch);
                        if (curl_errno($ch)) {
                            $errors[] = "Failed to copy file: $fileName. Error: " . curl_error($ch);
                        }
                        curl_close($ch);
                    }
                }
            }

            // echo json_encode($data);
            return redirect()->back()->with('success', 'Data berhasil diubah');
        }
    }

    public function edit($id)
    {
        //
    }
}
