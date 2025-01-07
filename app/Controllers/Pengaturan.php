<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Pengaturan extends BaseController
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
        //
        $listData = ['Akun', 'BBM', 'Driver', 'Batas Wilayah', 'Lokasi Garasi', 'Unit', 'Pengguna', 'Ganti Password'];

        return view('pengaturan/index', ['title' => 'Pengaturan', 'listData' => $listData]);
    }

    public function akun()
    {
        return redirect()->to('/akun');
    }

    public function bbm()
    {
        /* params: 
         * caller required, default: MASTER
         * kd_member required
         */
        // echo json_encode($this->session->get('user'));

        $listData = [];
        
        // handle POST
        if ($this->request->getMethod() == 'POST') {
            $data = $this->request->getPost();
            // echo json_encode($data);
            // $kd_member = $data['kd_member'];
            // $nm_bbm = $data['nm_bbm'];
            // $hrg_bbm = $data['hrg_bbm'];

            // lakukan validasi data
            $validation =  \Config\Services::validation();
            $validation->setRules([
                'nm_bbm' => 'required',
                'hrg_bbm' => 'required',
            ]);
            $isDataValid = $validation->withRequest($this->request)->run();

            // jika data vlid, maka submit
            if($isDataValid){
                // if kode is exist, then update  
                if(isset($data['kode'])){
                    $submitData = getCurl([
                        'kd_bbm' => $data['kode'],
                        'nm_bbm' => $data['nm_bbm'],
                        'hrg_bbm' => $data['hrg_bbm'],
                    ], $this->ipAddress . 'update_bbm.php');
                } else {
                    $submitData = getCurl([
                        'kd_member' => $this->session->get('user')['kode'],
                        'nm_bbm' => $data['nm_bbm'],
                        'hrg_bbm' => $data['hrg_bbm'],
                    ], $this->ipAddress . 'add_bbm.php');
                }
                // echo json_encode($submitData);
                if($submitData['success'] == '1'){
                    $this->session->setFlashdata('success', 'Data berhasil disimpan');
                } else {
                    $this->session->setFlashdata('error', 'Data gagal disimpan');
                }

            } else {
                $this->session->setFlashdata('error', 'Data tidak valid');
            }
        }

        if(empty($listData)) $listData = getCurl([
            'caller' => 'MASTER',
            'kd_member' => $this->session->get('user')['kode']
        ], $this->ipAddress . 'select_bbm.php');
        // echo json_encode($listData); die();
        // if($listData['success']){
        //     $listData = $listData['result_bbm'];
        // }

        return view('pengaturan/bbm', [
            'title' => 'BBM',
            'listData' => $listData['result_bbm']
        ]);
    }

    public function driver()
    {
        /* add_driver.php params: 
         * kd_member required
         * kd_kat required
         * dlm_kota required
         * dlm_prop required
         * luar_prop required
         * makan required
         * hotel required
         * fee required
         */
        // echo json_encode($this->session->get('user'));

        $listData = [];
        $listKategori = [];
        
        // handle POST
        if ($this->request->getMethod() == 'POST') {
            $data = $this->request->getPost();
            // echo json_encode($data);
            /* update_driver.php params: 
             * id required
             * kd_kat required
             * dlm_kota required
             * dlm_prop required
             * luar_prop required
             * makan required
             * hotel required
             * fee optional
             */

            // lakukan validasi data
            $validation =  \Config\Services::validation();
            $validation->setRules([
                'id' => 'required',
                'kd_kat' => 'required',
                'dlm_kota' => 'required',
                'dlm_prop' => 'required',
                'luar_prop' => 'required',
                'makan' => 'required',
                'hotel' => 'required',
                // 'fee' => 'required',
            ]);
            $isDataValid = $validation->withRequest($this->request)->run();

            if($isDataValid){
                if(isset($data['id'])){
                    $submitData = getCurl([
                        'id' => $data['id'],
                        'kd_kat' => $data['kd_kat'],
                        'dlmkota' => $data['dlm_kota'],
                        'dlmprop' => $data['dlm_prop'],
                        'luarprop' => $data['luar_prop'],
                        'makan' => $data['makan'],
                        'hotel' => $data['hotel'],
                        'fee' => ($data['fee']) ? $data['fee'] : 0,
                    ], $this->ipAddress . 'update_driver.php');
                } else {
                    $submitData = getCurl([
                        'kd_member' => $this->session->get('user')['kode'],
                        'kd_kat' => $data['kd_kat'],
                        'dlmkota' => $data['dlm_kota'],
                        'dlmprop' => $data['dlm_prop'],
                        'luarprop' => $data['luar_prop'],
                    ], $this->ipAddress . 'add_driver.php');
                }
                // echo json_encode($submitData);
                if($submitData['success'] == '1'){
                    $this->session->setFlashdata('success', 'Data berhasil disimpan');
                } else {
                    $this->session->setFlashdata('error', 'Data gagal disimpan');
                }
            } else {
                $this->session->setFlashdata('error', 'Data tidak valid');
            }
        }

        if(empty($listData)) $listData = getCurl([
            'caller' => 'MASTER',
            'kd_member' => $this->session->get('user')['kode']
        ], $this->ipAddress . 'select_driver.php');
        // echo json_encode($listData); die();

        if(empty($listKategori)) $listKategori = getCurl(['kd_member' => $this->session->get('user')['kode']], $this->ipAddress . 'select_kategori.php');
        
        return view('pengaturan/driver', [
            'title' => 'Driver',
            'listData' => $listData,
            'listKategori' => $listKategori
        ]);
    }

    public function batasWilayah()
    {
        /* params: 
         * caller optional
         * kd_member required
         */
        // echo json_encode($this->session->get('user'));

        $listData = [];
        $listLokasi = [];

        if(empty($listData)) $listData = getCurl([
            'caller' => 'MASTER',
            'kd_member' => $this->session->get('user')['kode']
        ], $this->ipAddress . 'select_wilayah.php');
        // echo json_encode($listData); die();

        return view('pengaturan/batas-wilayah', [
            'title' => 'Batas Wilayah',
            'listData' => $listData['result_wilayah']
        ]);
    }

    public function lokasiGarasi()
    {
        /* params: 
         * caller optional
         * kd_member required
         */
        // echo json_encode($this->session->get('user'));

        $listData = [];
        $listkota = [];
        
        // handle POST
        if ($this->request->getMethod() == 'POST') {
            $data = $this->request->getPost();
            // echo json_encode($data);
            // $kd_member = $data['kd_member'];
            // $kd_kota = $data['kd_kota'];

            // lakukan validasi data
            $validation =  \Config\Services::validation();
            $validation->setRules([
                'kd_kota' => 'required',
            ]);
            $isDataValid = $validation->withRequest($this->request)->run();

            // jika data vlid, maka submit
            if($isDataValid){
                $submitData = getCurl([
                    'kd_member' => $this->session->get('user')['kode'],
                    'kd_kota' => $data['kd_kota'],
                ], $this->ipAddress . 'add_garasi.php');
                // echo json_encode($submitData);
                if($submitData['success'] == '1'){
                    $this->session->setFlashdata('success', 'Data berhasil disimpan');
                } else {
                    $this->session->setFlashdata('error', 'Data gagal disimpan');
                }

            } else {
                // $error['error'] = $validation->getErrors();
                $this->session->setFlashdata('error', 'Data tidak valid');
            }

        }

        if(empty($listData)) $listData = getCurl([
            // 'caller' => 'MASTER',
            'kd_member' => $this->session->get('user')['kode']
        ], $this->ipAddress . 'select_garasi.php');
        // echo json_encode($listData); die();

        if(empty($listkota)) $listkota = getCurl([], $this->ipAddress . 'select_kota_1.php');

        return view('pengaturan/lokasi-garasi', [
            'title' => 'Lokasi Garasi',
            'listData' => $listData['result_garasi'],
            'listkota' => $listkota['result_kota']
        ]);
    }

    public function unit()
    {
        /* params: 
         * caller optional
         * kd_member required
         */
        // echo json_encode($this->session->get('user'));
        // select_unit_1.php
        // select_unit_by_name_1.php
        // select_user.php
        // select_kategori.php
        // select_bbm.php
        // add_unit_1.php
        // update_unit_1.php

        $listData = [];
        $listPaketDriver = [];
        $listPaketBbm    = [];

        $curlOpt    = [
            'caller' => 'MASTER',
            'kd_member' => $this->session->get('user')['kode']
        ];

        if(empty($listData)) $listData = getCurl($curlOpt, $this->ipAddress . 'select_unit_1.php');
        // echo json_encode($listData);

        if(empty($listPaketDriver)) $listPaketDriver = getCurl($curlOpt, $this->ipAddress . 'select_driver.php');
        // echo json_encode($listDriver);

        if(empty($listPaketBbm)) $listPaketBbm = getCurl($curlOpt, $this->ipAddress . 'select_bbm.php');

        return view('pengaturan/unit', [
            'title' => 'Unit',
            'listData' => $listData['result_unit'],
            'listPaketDriver' => $listPaketDriver['result_driver'],
            'listPaketBbm'    => $listPaketBbm['result_bbm']
        ]);
    }

    public function pengguna()
    {
        /* params: 
         * caller optional
         * kd_member required
         */

        $listData   = [];
        $curlOpt    = [
            'caller' => 'MASTER',
            'kd_member' => $this->session->get('user')['kode']
        ];
        
        // handle POST
        if ($this->request->getMethod() == 'POST') {
            $data = $this->request->getPost();

            // lakukan validasi data
            $validation =  \Config\Services::validation();
            $validation->setRules([
                'nama' => 'required',
                'nohp' => 'required',
            ]);
            $isDataValid = $validation->withRequest($this->request)->run();

            // jika data valid, maka submit
            if($isDataValid){
                $submitData = getCurl([
                    'nama' => $data['nama'],
                    'nohp' => $data['nohp'],
                ], $this->ipAddress . 'add_staf.php');
                // echo json_encode($submitData);
                // jika berhasil, maka tampilkan pesan
                if($submitData['success'] == '1'){
                    $this->session->setFlashdata('success', 'Data berhasil disimpan');
                } else {
                    $this->session->setFlashdata('error', 'Data gagal disimpan');
                }

            } else {
                // $error['error'] = $validation->getErrors();
                $this->session->setFlashdata('error', 'Data tidak valid');
            }

        }

        if(empty($listData)) $listData = getCurl($curlOpt, $this->ipAddress . 'select_staf.php');
        // echo json_encode($listData);
        
        return view('pengaturan/pengguna', [
            'title' => 'Pengguna',
            'listData' => $listData['result']
        ]);
    }

    public function gantiPassword()
    {
        //
        return view('pengaturan/ganti-pwd', ['title' => 'Ganti Password']);
    }
}
