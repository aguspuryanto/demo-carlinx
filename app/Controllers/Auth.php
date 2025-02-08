<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    protected $ipAddress;
    protected $destinationUrl = 'http://103.178.174.7/foxrent/upload_profile.php';

    public function __construct()
    {
        helper('my');
        $this->ipAddress = $_ENV['API_BASEURL'];
    }

    public function index()
    {
        //
    }

    public function register()
    {
        $jabatan = ['0' => 'CEO', '1' => 'DIREKTUR', '2' => 'MANAGER'];
        $cityList = [];
        $korwilList = [];

        if (empty($cityList)) {
            $cityList = getCurl([], $this->ipAddress . 'select_kota_1.php');
        }

        if (empty($korwilList)) {
            $korwilList = getCurl([], $this->ipAddress . 'select_korwil.php');
        }

        return view('auth/register', [
            'title' => 'Register',
            'jabatan' => $jabatan,
            'cityList' => $cityList,
            'korwilList' => $korwilList
        ]);
    }

    public function registerSubmit()
    {
        $session = session();

        $listData = [];

        // Handle POST request
        if ($this->request->getMethod() == 'POST') {
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $data = $this->request->getPost();

            $curlOpt = [
                'nama' => $data['nama'],
                'alamat' => $data['alamat'],
                'kd_kota' => $data['kd_kota'],
                'nama_perush' => $data['nama_perush'],
                'ijin_perush' => $data['ijin_perush'],
                'email_addr' => $data['email'],
                'layanan' => isset($data['layanan'][0]) ? 1 : 0,
                'event' => isset($data['layanan'][1]) ? 1 : 0,
                'bulanan' => isset($data['layanan'][2]) ? 1 : 0,
                'lepaskunci' => isset($data['layanan'][3]) ? 1 : 0,
                'grup' => $data['grup_rental'],
                'jabatan' => $data['jabatan'],
                'usernm' => $data['no_hp'],
                'passwd' => $data['password'],
                'kd_korwil' => $data['kd_korwil'],
            ];

            $listData = getCurl($curlOpt, $this->ipAddress . 'reg_user_2.php');

            $files = ['foto_diri', 'foto_kantor', 'foto_garasi', 'foto_order'];
            $errors = [];

            if ($listData['success'] == "1") {
                $kd_site = $listData['message2'];

                foreach ($files as $k => $file) {
                    if (isset($_FILES[$file]) && $_FILES[$file]['size'] > 0) {
                        $fileName = $kd_site . "_" . ($k + 1) . ".jpg";
                        $targetFile = $uploadDir . $fileName;

                        if (!move_uploaded_file($_FILES[$file]['tmp_name'], $targetFile)) {
                            $errors[] = "Failed to upload file: $fileName. Please check file permissions and try again.";
                        }
                    }
                }

                // Copy files to destination server
                $this->syncupload();

                if (empty($errors)) {
                    return redirect()->to('/login')->with('success', 'Registration successful! Please login.');
                    // echo json_encode(["status" => "success", "message" => "Semua file berhasil diupload"]);
                } else {
                    return redirect()->to('/register')->with('error', 'Registration failed! Please try again. <br>' . implode(", ", $errors));
                    // http_response_code(500);
                    // echo json_encode(["status" => "error", "message" => implode(", ", $errors)]);
                }
            } else {
                return redirect()->to('/register')->with('error', 'Registration failed! Please try again. <br>' . $listData['message']);
            }
        }
    }

    public function login()
    {
        return view('auth/login', ['title' => 'Login']);
    }

    public function loginSubmit()
    {
        $session = session();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userData = getCurl(['usernm' => $username], $this->ipAddress . 'select_user.php');

        if ($userData) {
            $userData['password'] = password_hash($password, PASSWORD_BCRYPT);
        }

        if ($userData['success'] == "1" && password_verify($password, $userData['password'])) {
            $session->set('isLoggedIn', true);
            $session->set('user', $userData['result'][0]);

            return redirect()->to('/');
        } else {
            return redirect()->back()->with('error', 'Invalid email or password!');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    function syncupload()
    {
        $uploadDir = 'uploads/';

        if (!is_dir($uploadDir)) {
            die("Directory not found!");
        }

        $files = array_diff(scandir($uploadDir), array('..', '.'));

        echo "<h3>Files in $uploadDir:</h3><ul>";
        foreach ($files as $file) {
            if (stripos($file, '.jpg') !== false || stripos($file, '.png') !== false) {
                echo "<li>$file</li>";
            }
        }
        echo "</ul>";

        foreach ($files as $file) {
            if (stripos($file, '.jpg') !== false || stripos($file, '.png') !== false) {
                $filePath = $uploadDir . $file;

                if (is_file($filePath)) {
                    $ch = curl_init();

                    $postData = [
                        'uploaded_file' => new \CURLFile($filePath)
                    ];

                    curl_setopt($ch, CURLOPT_URL, $this->destinationUrl);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                    $response = curl_exec($ch);
                    if (curl_errno($ch)) {
                        echo "Failed to upload $file: " . curl_error($ch) . "<br>";
                    } else {
                        echo "Successfully uploaded $file to $this->destinationUrl <br>";
                    }
                    curl_close($ch);
                }
            }
        }
    }
}
