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
                // 'id' => 'required',
                'kd_kat' => 'required',
                'dlm_kota' => 'required',
                'dlm_prop' => 'required',
                'luar_prop' => 'required',
                'makan' => 'required',
                'hotel' => 'required',
            ]);
            $isDataValid = $validation->withRequest($this->request)->run();

            if($isDataValid){
                if(isset($data['id'])){
                    $dataArray = [
                        'id' => $data['id'],
                        'kd_kat' => $data['kd_kat'],
                        'dlm_kota' => $data['dlm_kota'],
                        'dlm_prop' => $data['dlm_prop'],
                        'luar_prop' => $data['luar_prop'],
                        'makan' => $data['makan'],
                        'hotel' => $data['hotel'],
                        'fee' => isset($data['fee']) ? $data['fee'] : 0,
                    ];
                    // echo json_encode($dataArray);
                    $submitData = getCurl($dataArray, $this->ipAddress . 'update_driver.php');
                } else {
                    $dataArray = [
                        'kd_member' => $this->session->get('user')['kode'],
                        'kd_kat' => $data['kd_kat'],
                        'dlmkota' => $data['dlm_kota'],
                        'dlmprop' => $data['dlm_prop'],
                        'luarprop' => $data['luar_prop'],
                        'makan' => $data['makan'],
                        'hotel' => $data['hotel'],
                    ];
                    $submitData = getCurl($dataArray, $this->ipAddress . 'add_driver.php');
                }
                // echo json_encode($submitData);
                if($submitData['success'] == '1'){
                    $this->session->setFlashdata('success', 'Data berhasil disimpan');
                } else {
                    $this->session->setFlashdata('error', 'Data gagal disimpan');
                }
            } else {
                echo json_encode($validation->getErrors());
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
        /* add_wilayah.php params: 
         * kd_member required
         * dlm_kota required
         * dlm_prop required
         * luar_batas required
         */
        // echo json_encode($this->session->get('user'));

        $listData = [];
        $listLokasi = [];
        
        // handle POST
        if ($this->request->getMethod() == 'POST') {
            $data = $this->request->getPost();
            // echo json_encode($data);
            // step1: add_wilayah.php, step2: update_wilayah_2.php

            /* update_wilayah_2.php params
             * id required
             * dlm_kota required
             * dlm_prop required
             * luar_batas optional
             * batas_1 required
             * batas_2
             * batas_3
             * batas_4
             * batas_5
             * batas_6        
             * hari_1
             * hari_2
             * hari_3
             * hari_4
             * hari_5
             * hari_6
             * ketr optional
             */

            // lakukan validasi data
            $validation =  \Config\Services::validation();
            $validation->setRules([
                // 'id' => 'required',
                'dlm_kota' => 'required',
                'dlm_prop' => 'required',
                'batas_1' => 'required',
                'batas_2' => 'required',
                'batas_3' => 'required',
                'batas_4' => 'required',
                'batas_5' => 'required',
                'batas_6' => 'required',
                'hari_1' => 'required',
                'hari_2' => 'required',
                'hari_3' => 'required',
                'hari_4' => 'required',
                'hari_5' => 'required',
                'hari_6' => 'required'
            ]);
            $isDataValid = $validation->withRequest($this->request)->run();

            if($isDataValid){
                if(isset($data['id'])){
                    $dataArray = [
                        'id' => $data['id'],
                        'dlm_kota' => $data['dlm_kota'],
                        'dlm_prop' => $data['dlm_prop'],
                        'luar_batas' => isset($data['luar_batas']) ?? 0,
                        'batas_1' => $data['batas_1'],
                        'batas_2' => $data['batas_2'],
                        'batas_3' => $data['batas_3'],
                        'batas_4' => $data['batas_4'],
                        'batas_5' => $data['batas_5'],
                        'batas_6' => $data['batas_6'],
                        'hari_1' => $data['hari_1'],
                        'hari_2' => $data['hari_2'],
                        'hari_3' => $data['hari_3'],
                        'hari_4' => $data['hari_4'],
                        'hari_5' => $data['hari_5'],
                        'hari_6' => $data['hari_6'],
                        'ketr' => $data['ketr']
                    ];
                    // echo json_encode($dataArray);
                    $submitData = getCurl($dataArray, $this->ipAddress . 'update_wilayah_2.php');
                } else {
                    $dataArray = [
                        'kd_member' => $this->session->get('user')['kode'],
                        'dlm_kota' => $data['dlm_kota'],
                        'dlm_prop' => $data['dlm_prop'],
                        'luar_batas' => $data['luar_batas']
                    ];
                    $submitData = getCurl($dataArray, $this->ipAddress . 'add_wilayah.php');
                }
                // echo json_encode($submitData);
                if($submitData['success'] == '1'){
                    $this->session->setFlashdata('success', 'Data berhasil disimpan');
                } else {
                    $this->session->setFlashdata('error', 'Data gagal disimpan');
                }
            } else {
                echo json_encode($validation->getErrors());
                $this->session->setFlashdata('error', 'Data tidak valid');
            }
        }

        if(empty($listData)) $listData = getCurl([
            'caller' => 'MASTER',
            'kd_member' => $this->session->get('user')['kode']
        ], $this->ipAddress . 'select_wilayah.php');
        // echo json_encode($listData); die();

        return view('pengaturan/batas-wilayah', [
            'title' => 'Batas Wilayah',
            'listData' => $listData
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
            'listData' => $listData,
            'listkota' => $listkota
        ]);
    }

    // lokasiGarasiDelete
    public function lokasiGarasiDelete()
    {
        /* params: 
         * kd_site required
         * kd_kota required
         */
        $data = $this->request->getPost();
        $dataArray = [
            'kd_site' => $data['kd_site'],
            'kd_kota' => $data['kd_kota']
        ];
        $submitData = getCurl($dataArray, $this->ipAddress . 'delete_garasi.php');
        echo json_encode($submitData);
    }

    public function unit()
    {
        /* params: 
         * caller optional
         * kd_member required
         */
        $listData = [];
        $listPaketDriver = [];
        $listPaketBbm    = [];
        $listKategori = [];

        $curlOpt = [
            'caller' => 'MASTER',
            'kd_member' => $this->session->get('user')['kode']
        ];

        // Initialize cache
        $cache = \Config\Services::cache();
        $cacheKey = 'unit_data_' . $this->session->get('user')['kode'];
        $cacheTime = 300; // 5 minutes cache

        // handle POST
        if ($this->request->getMethod() == 'POST') {
            $data = $this->request->getPost();

            $updateData = [
                'kd_unit' => $data['kd_unit'],
                'nama' => $data['nama'],
                'kategori' => $data['kategori'],
                'bbm' => $data['bbm'],
                'dlm_kota' => $data['dlm_kota'],
                'dlm_prop' => $data['dlm_prop'],
                'luar_prop' => $data['luar_prop'],
                'lepas_kunci' => $data['lepas_kunci'],
                'biaya_antar' => $data['biaya_antar'],
                'biaya_ambil' => $data['biaya_ambil'],
                'tuslah' => $data['tuslah'],
                'is_tuslah' => $data['is_tuslah'],
                'stat' => isset($data['stat']) ? 1 : 0,
                'kons_bbm' => $data['kons_bbm'],
                'kursi' => $data['kursi'],
                'tahun' => $data['tahun'],
                'transmisi' => $data['transmisi'],
                'warna' => $data['warna'],
                'drop_in' => $data['drop_in'],
                'over_time' => $data['over_time'],
                'fee' => $data['fee'],
                'stgh_hr' => $data['stgh_hr'],
                'bulanan' => $data['bulanan']
            ];

            $resultData = getCurl($updateData, $this->ipAddress . 'update_unit_1.php');
            
            if($resultData['success'] == '1'){
                // Clear cache on successful update
                $cache->delete($cacheKey);
                $this->session->setFlashdata('success', 'Data berhasil diubah');
            } else {
                $this->session->setFlashdata('error', 'Data gagal diubah ' . $resultData['error_message']);
            }
        }

        // Try to get data from cache first
        $cachedData = $cache->get($cacheKey);
        
        if ($cachedData === null) {
            // If not in cache, fetch from API
            if(empty($listData)) $listData = getCurl($curlOpt, $this->ipAddress . 'select_unit_1.php');
            if(empty($listPaketDriver)) $listPaketDriver = getCurl($curlOpt, $this->ipAddress . 'select_driver.php');
            if(empty($listPaketBbm)) $listPaketBbm = getCurl($curlOpt, $this->ipAddress . 'select_bbm.php');
            if(empty($listKategori)) $listKategori = getCurl(['kd_member' => $this->session->get('user')['kode']], $this->ipAddress . 'select_kategori.php');

            // Store in cache
            $cacheData = [
                'listData' => $listData,
                'listPaketDriver' => $listPaketDriver,
                'listPaketBbm' => $listPaketBbm,
                'listKategori' => $listKategori
            ];
            $cache->save($cacheKey, $cacheData, $cacheTime);
        } else {
            // Use cached data
            $listData = $cachedData['listData'];
            $listPaketDriver = $cachedData['listPaketDriver'];
            $listPaketBbm = $cachedData['listPaketBbm'];
            $listKategori = $cachedData['listKategori'];
        }

        return view('pengaturan/unit', [
            'title' => 'Unit',
            'listData' => $listData,
            'listPaketDriver' => $listPaketDriver,
            'listPaketBbm'    => $listPaketBbm,
            'listKategori'    => $listKategori,
        ]);
    }

    public function unitDetail($id)
    {

        $listData = [];
        $listPaketDriver = [];
        $listPaketBbm    = [];
        $listKategori = [];

        $curlOpt    = [
            'caller' => 'MASTER',
            'kd_member' => $this->session->get('user')['kode']
        ];

        // if(empty($listData)) $listData = getCurl($curlOpt, $this->ipAddress . 'select_unit_1.php');
        // echo json_encode($listData);
        
        // Filter $listData where kode matches $id
        // $listData = array_filter($listData['result_unit'], function($item) use ($id) {
        //     return $item['kode'] == $id;
        // });

        if(empty($listData)) $listData = getCurl(['kd_unit' => $id], $this->ipAddress . 'select_unit_by_kode.php');
        // echo json_encode($listData);

        if(empty($listPaketDriver)) $listPaketDriver = getCurl($curlOpt, $this->ipAddress . 'select_driver.php');
        // echo json_encode($listPaketDriver);

        if(empty($listPaketBbm)) $listPaketBbm = getCurl($curlOpt, $this->ipAddress . 'select_bbm.php');
        // echo json_encode($listPaketBbm);

        if(empty($listKategori)) $listKategori = getCurl(['kd_member' => $this->session->get('user')['kode']], $this->ipAddress . 'select_kategori.php');
        // echo json_encode($listKategori);

        // echo "Detail unit dengan ID: " . $id;
        return view('pengaturan/unit-detail', [
            'title' => 'Unit Detail',
            'id' => $id,
            'listData' => $listData,
            'listPaketDriver' => $listPaketDriver,
            'listPaketBbm'    => $listPaketBbm,
            'listKategori'    => $listKategori,
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
                if(isset($data['id'])) {
                    // $kd_member = $_POST['kd_member'];
                    // $nama = $_POST['nama'];
                    // $stat = $_POST['stat'];

                    $curlOpt['nama'] = $data['nama'];
                    $curlOpt['stat'] = $data['stat'];

                    $submitData = getCurl($curlOpt, $this->ipAddress . 'update_staf.php');
                } else {
                    // $kd_member = $_POST['kd_member'];
                    // $nama = $_POST['nama'];
                    // $kd_site = $_POST['kd_site'];		
                    // $nohp_0 = $_POST['nohp'];

                    $curlOpt['nama'] = $data['nama'];
                    $curlOpt['nohp'] = $data['nohp'];
                    // $curlOpt['kd_site'] = $data['kd_site'];

                    $submitData = getCurl($curlOpt, $this->ipAddress . 'add_staf.php');
                }
                // echo json_encode($submitData);

                // jika berhasil, maka tampilkan pesan
                if($submitData['success'] == '1'){
                    $this->session->setFlashdata('success', 'Data berhasil disimpan');
                } else {
                    $this->session->setFlashdata('error', 'Data gagal disimpan. ' . json_encode($submitData));
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
            'listData' => $listData
        ]);
    }

    public function gantiPassword()
    {
        // echo json_encode($this->session->get('user'));
        $sessionUser = $this->session->get('user');

        // handle POST
        if ($this->request->getMethod() == 'POST') {
            $data = $this->request->getPost();
            // echo json_encode($data);            
            // $nohp_0 = $_POST['usernm'];
            // $passwd_0 = $_POST['passwd'];
            if($data) {
                $curlOpt = [
                    'usernm' => $data['usernm'],
                    'passwd' => $data['passwd']
                ];
                $submitData = getCurl($curlOpt, $this->ipAddress . 'update_user_pass.php');
                // echo json_encode($submitData);
                if($submitData['success'] == '1'){
                    $this->session->setFlashdata('success', 'Password berhasil diubah');
                } else {
                    $this->session->setFlashdata('error', 'Password gagal diubah');
                }
            }
        }

        return view('pengaturan/ganti-pwd', ['title' => 'Ganti Password', 'sessionUser' => $sessionUser]);
    }

    public function hitungHarga()
    {
       /*Api yg kepakae:
        1. hitung_harga_dasar.php --> klo klik tombol gambar panah
        
        Parameter:
        1. hitung_harga_dasar:
        - kd_member
        - kd_unit
        - wilayah
        - jarak
        - harga
        - hari

        dimana
        1. Wilayah --> dalam kota = 1, Dlm Propinsi. = 2, Luar Batas = 3*/
        
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
            // echo json_encode($data); die(); //{"wilayah":"1","lokasi_jemput2":"Indonesia, 60261, Surabaya","lokasi_tujuan2":"Indonesia, 65119, Malang Kota","hari":"1","harga":"450000","harga_dasar":""}

            // lakukan validasi data
            $validation =  \Config\Services::validation();
            $validation->setRules([
                'wilayah' => 'required',
                'jarak' => 'required',
                'harga' => 'required',
                'hari' => 'required',
            ]);

            $isDataValid = $validation->withRequest($this->request)->run();
            if($isDataValid){
                // format jarak
                $data['jarak'] = format_km($data['jarak']);
                $data['kd_unit'] = $data['id'];

                $curlOpt = array_merge($curlOpt, $data);
                // echo json_encode($curlOpt); die();
                $listData = getCurl($curlOpt, $this->ipAddress . 'hitung_harga_dasar.php');
            }
        }

        // echo json_encode($listData);
        return $this->response->setJSON($listData);
    }

    public function updateHarga()
    {
        // 2. update_harga_dasar.php --> klo klik Simpan Hasil Perhitungan
        // 2. update_harga_dasar:
        // - kd_unit
        // - wilayah
        // - harga

        /* params: 
         * caller required, default: MASTER
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
            // echo json_encode($data); die(); //{"wilayah":"1","lokasi_jemput2":"Indonesia, 60261, Surabaya","lokasi_tujuan2":"Indonesia, 65119, Malang Kota","hari":"1","harga":"650000","harga_dasar":"300000","jarak":"194.997","id":"22040001AV0002"}

            $newData = [
                'kd_unit' => $data['id'],
                'wilayah' => $data['wilayah'],
                'harga' => $data['harga_dasar'],
            ];

            $curlOpt = array_merge($curlOpt, $newData);
            // echo json_encode($curlOpt); die();
            $listData = getCurl($curlOpt, $this->ipAddress . 'update_harga_dasar.php');
            
            if($listData['success'] == '1') {
                // redirect to home
                return redirect()->to('pengaturan/unit-detail/' . $data['id'])->with('success', 'Harga dan Biaya Pelayanan berhasil diupdate');
            } else {
                // show error
                // echo json_encode($listData);
                return redirect()->to('pengaturan/unit-detail/' . $data['id'])->with('error', $listData['message']);
            }
        }

        // echo json_encode($listData);
        // return $this->response->setJSON($listData);
    }
}
