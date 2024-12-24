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
            $nm_bbm = $data['nm_bbm'];
            $hrg_bbm = $data['hrg_bbm'];

            $submitData = getCurl([
                'kd_member' => $this->session->get('user')['kode'],
                'nm_bbm' => $nm_bbm,
                'hrg_bbm' => $hrg_bbm,
            ], $this->ipAddress . 'select_bbm.php');

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
        /* params: 
         * caller optional
         * kd_member required
         */
        // echo json_encode($this->session->get('user'));

        $listData = [];

        if(empty($listData)) $listData = getCurl([
            'caller' => 'MASTER',
            'kd_member' => $this->session->get('user')['kode']
        ], $this->ipAddress . 'select_driver.php');
        // echo json_encode($listData); die();
        
        return view('pengaturan/driver', [
            'title' => 'Driver',
            'listData' => $listData['result_driver']
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

        if(empty($listData)) $listData = getCurl([
            // 'caller' => 'MASTER',
            'kd_member' => $this->session->get('user')['kode']
        ], $this->ipAddress . 'select_garasi.php');
        // echo json_encode($listData); die();

        return view('pengaturan/lokasi-garasi', [
            'title' => 'Lokasi Garasi',
            'listData' => $listData['result_garasi']
        ]);
    }

    public function unit()
    {
        //
        return view('pengaturan/unit', ['title' => 'Unit']);
    }

    public function pengguna()
    {
        //
        return view('pengaturan/pengguna', ['title' => 'Pengguna']);
    }

    public function gantiPassword()
    {
        //
        return view('pengaturan/ganti-pwd', ['title' => 'Ganti Password']);
    }
}
