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
        // echo json_encode($req); die(); //{"usernm":"+62876543210","nama":"Foxie","nama_pt":"GASIK TRANSX","jabatan":"0","ijin_pt":"123.456.789.00","norek":"BCA 001.1234.5678a\/n Gemilang Kreasi Kami","alamat":"Tenggilis Mejoyo","kota":"KOTA SURABAYA","email":"april_id2000@yahoo.com","hp_perush":"+62818336745","hp_cs":"+6281131183229","is_layanan":"on","is_bulanan":"on","is_lepaskunci":"on"}

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
            // upload file
            $data = [];
            
            // echo print_r($_FILES['uploaded_file']);
            if(isset($_FILES['uploaded_file'])){
                // $getCurl = getCurl($_FILES, $this->ipAddress . 'upload_profile.php');
                // echo json_encode($getCurl);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_VERBOSE, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
                curl_setopt($ch, CURLOPT_URL, $this->ipAddress . 'upload_profile.php');
                curl_setopt($ch, CURLOPT_POST, true);
                // same as <input type="file" name="file_box">
                // $post = array(
                //     "file_box"=>"@/path/to/myfile.jpg",
                // );
                curl_setopt($ch, CURLOPT_POSTFIELDS, $_FILES['uploaded_file']); 
                $response = curl_exec($ch);
                // echo $response;
            }

            
            // $foto_4 = $this->request->getFile('uploaded_file');
            // if (!$foto_4->hasMoved()) {
            //     $filename = $foto_4->getRandomName();
            //     // $foto_4->move(ROOTPATH . 'public/uploads/', $filename);
            //     $data = ['foto_4' => ($filename)];
            // }

            // echo json_encode($data);
            return redirect()->back()->with('success', 'Data berhasil diubah');
        }
    }

    public function edit($id)
    {
        //
    }
}
