<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Proses extends BaseController
{
    protected $ipAddress;
    protected $session;

    public function __construct()
    {
        helper('my');
        $this->ipAddress = $_ENV['API_BASEURL'];
        // $this->session = session();
        // // jika tidak ada session, redirect ke login
        // if (!$this->session->get('user') || !isset($this->session->get('user')['kode'])) {
        //     return redirect()->to('/login');
        // }
        
        $this->session = \Config\Services::session();
        $user = $this->session->get('user');
        if (!$user || !isset($user['kode'])) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }
    }
    
    public function index()
    {
        /* params: 
         * caller optional
         * kd_member required
         */
        // echo json_encode($this->session->get('user'));

        $listData   = [];
        $listUser   = [];
        $curlOpt    = [
            'caller' => 'AKTIF', // default. INBOX, AKTIF, RIWAYAT
            'kd_member' => $this->session->get('user')['kode']
        ];

        //update status terbaru
        // 1 = baru; 2 = diterima; 3 = data plgn; 4 = data driver + invoice;
        // 5 = konfirmasi bayar (upload bukti transfer)
        // 6 = tolak by rental; 7 = batal by rental; 8 = batal by pemesan
        // 9 = pembayaran diterima (order selesai - ke menu Proses)

        // sisi pemesan
        // Stat : 1 = Menunggu
        // Stat : 4 = Butuh Tindakan
        // Stat : 5 = Menunggu
        // Stat : 6 = Ditolak
        // Stat : 7 = Rental Batal
        // Stat : 8 = Kedaluwarsa
        // Stat : 9 = Selesai

        // sisi rental
        // Stat : 1 = Order Baru
        // Stat : 4 = Menunggu
        // Stat : 5 = Tunggu Pembayaran
        // Stat : 6 = Ditolak
        // Stat : 7 = Rental Batal
        // Stat : 8 = Pemesan Batal
        // Stat : 9 = Selesai

        $listStatus = [];
        $listStatus_pemesan = [
            '1' => 'Menunggu',
            '2' => 'Diterima',
            '3' => 'Data Plgn',
            '4' => 'Butuh Tindakan',
            '5' => 'Menunggu',
            '6' => 'Ditolak', //'Tolak By Rental',
            '7' => 'Rental Batal',
            '8' => 'Kedaluwarsa', //'Batal By Pemesan',
            '9' => 'Selesai', //'Pembayaran Diterima'
        ];

        $listStatus_rental = [
            '1' => 'Order Baru',
            '4' => 'Menunggu',
            '5' => 'Tunggu Pembayaran',
            '6' => 'Ditolak',
            '7' => 'Rental Batal',
            '8' => 'Pemesan Batal',
            '9' => 'Selesai'
        ];

        // grp_penyewa
        $listGroup = [
            '2' => 'In',
            '1' => 'Out',
        ];

        // jns_order
        $listOrder = [
            '1' => 'Pelayanan',
            '2' => 'Lepas Kunci',
            // '3' => 'Mobil',
            '4' => 'Bulanan',
            // '5' => 'Paket',
        ];

        $dataLogin = [
            'usernm' => $this->session->get('user')['username'],
            'passwd' => $this->session->get('user')['password']
        ];
        // if(empty($listUser)) $listUser = getCurl($dataLogin, $this->ipAddress . 'login_user.php');
        if(empty($listUser)) $listUser = ($this->session->get('user'));
        // echo json_encode($listUser); die();

        if(empty($listData)) $listData = getCurl($curlOpt, $this->ipAddress . 'select_order_5.php');
        
        if ($listData === null) {
            // Handle JSON decode error
            echo "Error decoding JSON";
            die();
        }
        
        $newlistData = [];
        if ($listData['success'] == '1') {
            foreach ($listData['result_list_order'] as $item) {
                // echo $item['stat'];
                // if(in_array($item['stat'], ['9'])) $newlistData[] = $item;
                if($item['stat']=='9') $newlistData[] = $item;
            }
        }
        // echo json_encode($newlistData);

        if($listData['success']){
            $listData = $listData;
            
            $is_vendor = ($listData['result_list_order'][0]['kode_rental'] == $listUser['kd_rental']) ? true : false;
            $is_pemesan = ($listData['result_list_order'][0]['kode_rental'] != $listUser['kd_rental']) ? true : false;

            if($is_vendor) $listStatus = $listStatus_rental;
            if($is_pemesan) $listStatus = $listStatus_pemesan;
        }

        return view('proses/index', [
            'title' => 'Proses',
            'listStatus' => $listStatus,
            'listGroup' => $listGroup,
            'listOrder' => $listOrder,
            'newlistData' => $newlistData,
            'listData' => $listData,
            'listUser' => $listUser
        ]);
    }

    // compress max 100kb
    protected function compressImage($source, $destination, $quality = 80)
    {
        // Get image info
        $imageInfo = getimagesize($source);
        if ($imageInfo === false) {
            throw new \Exception('Invalid image file');
        }

        // Create image resource based on type
        switch ($imageInfo[2]) {
            case IMAGETYPE_JPEG:
                $image = imagecreatefromjpeg($source);
                break;
            case IMAGETYPE_PNG:
                $image = imagecreatefrompng($source);
                // Preserve transparency for PNG
                imagealphablending($image, false);
                imagesavealpha($image, true);
                break;
            case IMAGETYPE_GIF:
                $image = imagecreatefromgif($source);
                break;
            default:
                throw new \Exception('Unsupported image type');
        }

        // Initial save to get file size
        $tempFile = tempnam(sys_get_temp_dir(), 'img');
        switch ($imageInfo[2]) {
            case IMAGETYPE_JPEG:
                imagejpeg($image, $tempFile, $quality);
                break;
            case IMAGETYPE_PNG:
                imagepng($image, $tempFile, 6);
                break;
            case IMAGETYPE_GIF:
                imagegif($image, $tempFile);
                break;
        }

        // Check file size and adjust quality if needed
        $maxSize = 100 * 1024; // 100KB in bytes
        $currentSize = filesize($tempFile);
        
        if ($currentSize > $maxSize) {
            // Calculate new quality based on current size
            $newQuality = floor(($maxSize / $currentSize) * $quality);
            $newQuality = max(10, $newQuality); // Don't go below 10% quality
            
            // Try again with new quality
            switch ($imageInfo[2]) {
                case IMAGETYPE_JPEG:
                    imagejpeg($image, $destination, $newQuality);
                    break;
                case IMAGETYPE_PNG:
                    // For PNG, we'll try to reduce dimensions if still too large
                    if (filesize($tempFile) > $maxSize) {
                        $this->resizeImage($image, $destination, $maxSize);
                    } else {
                        imagepng($image, $destination, 9);
                    }
                    break;
                case IMAGETYPE_GIF:
                    imagegif($image, $destination);
                    break;
            }
        } else {
            // If within size limit, just move the temp file
            rename($tempFile, $destination);
        }

        // Clean up
        imagedestroy($image);
        if (file_exists($tempFile)) {
            unlink($tempFile);
        }

        return true;
    }

    protected function resizeImage($image, $destination, $maxSize)
    {
        $width = imagesx($image);
        $height = imagesy($image);
        $ratio = $width / $height;
        
        // Start with 80% of original size
        $newWidth = $width * 0.8;
        $newHeight = $newWidth / $ratio;
        
        $newImage = imagecreatetruecolor($newWidth, $newHeight);
        
        // Preserve transparency for PNG
        imagealphablending($newImage, false);
        imagesavealpha($newImage, true);
        
        imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        
        // Save with maximum compression
        imagepng($newImage, $destination, 9);
        
        // If still too large, try again with smaller dimensions
        if (filesize($destination) > $maxSize) {
            $this->resizeImage($newImage, $destination, $maxSize);
        }
        
        imagedestroy($newImage);
    }

    public function confirm()
    {
        $listData = [];

        // handle POST
        if ($this->request->getMethod() == 'POST') {
            $data = $this->request->getPost();
            // echo print_r($_FILES); die();
            // echo json_encode($data); die();

            // upload dokumen serah/terima
            // API: upload_foto_lk.php
            // Set the target directory for uploaded images
            $uploadDir = "images_lk/";

            // Check if the uploads directory exists, if not, create it
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if(isset($_FILES['foto_serah']) && $_FILES['foto_serah']['error'] === 0 && $_FILES['foto_serah']['size'] > 0){
                $fileKey = 'foto_serah';
            }
            if(isset($_FILES['foto_terima']) && $_FILES['foto_terima']['error'] === 0 && $_FILES['foto_terima']['size'] > 0){
                $fileKey = 'foto_terima';
            }

            if(isset($fileKey) && $fileKey){
                if($fileKey == 'foto_serah'){
                    $fileName = $data['id_order'] . "_SRH.jpg";
                }
                if($fileKey == 'foto_terima'){
                    $fileName = $data['id_order'] . "_TRM.jpg";
                }

                $targetFile = $uploadDir . $fileName;
                
                try {
                    // Compress and save the image
                    $this->compressImage($_FILES[$fileKey]['tmp_name'], $targetFile);
                    
                    if (is_file($targetFile) && file_exists($targetFile)) {
                        $ch = curl_init();

                        $postData = [
                            'uploaded_file' => new \CURLFile($targetFile)
                        ];

                        curl_setopt($ch, CURLOPT_URL, $this->ipAddress . 'upload_foto_lk.php');
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                        $response = curl_exec($ch);
                        if (curl_errno($ch)) {
                            $errors[] = "Failed to copy file: $fileName. Error: " . curl_error($ch);
                        }
                        curl_close($ch);
                    }
                } catch (\Exception $e) {
                    $errors[] = "Failed to process image: " . $e->getMessage();
                }
            }

            if(!empty($errors)){
                $response = [
                    'success' => false,
                    'message' => $errors
                ];
            } else {
                if($data['action'] == 'unggah'){
                    $response = [
                        'success' => true,
                        'message' => 'Foto berhasil diunggah'
                    ];
                } else {
                    $curlOpt = [
                        'id_order' => $data['id_order'],
                        'stat_ori' => $data['stat']
                    ];
                    $listData = getCurl($curlOpt, $this->ipAddress . 'update_order_closed_1.php');
                    // echo json_encode($listData); die();
                    
                    $response = [
                        'success' => ($listData['success']=='1') ? true : false,
                        'message' => $listData['message']
                    ];
                }
            }

            echo json_encode($response);
            // return redirect()->to(base_url('inbox'))->with('success', 'Order confirmed successfully');
        }
    }
}
