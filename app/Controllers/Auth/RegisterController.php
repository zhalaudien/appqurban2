<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CabangModel;
use App\Models\UserModel;
use App\Models\SettingModel;

class RegisterController extends BaseController
{
    protected CabangModel $cabang;
    protected SettingModel $setting;


    public function __construct()
    {
        $this->cabang = new CabangModel();
        $this->setting = new SettingModel();
    }

    public function index()
    {
        $data = [
            'cabang' => $this->cabang
                ->where('pusat', 7)
                ->orderBy('nama_cabang', 'ASC')
                ->findAll(),

            // cek session saja
            'hasAccess' => session()->get('register_access') ?? false
        ];

        return view('auth/register', $data);
    }

    public function store()
    {
        $userModel = new UserModel();

        // 1. Validasi Kode Akses (Harus sama dengan yang ada di Setting)
        $inputCode = $this->request->getPost('access_code');

        // Ambil baris pertama dari tabel setting (Singleton pattern)
        $settingData = $this->setting->first();

        // Ambil nilai dari kolom access_password yang ada di database
        $realCode = $settingData['access_password'] ?? '';

        // Gunakan trim untuk menghindari spasi tak sengaja dan dukung pengecekan hash (password_verify)
        $isValid = (trim((string)$inputCode) === trim((string)$realCode)) || password_verify((string)$inputCode, (string)$realCode);

        if (!$isValid) {
            return redirect()->back()->withInput()->with('error', 'Kode akses pendaftaran tidak valid!');
        }

        // 2. Persiapan Data
        $cabangIdInput = $this->request->getPost('cabang_id');

        // Role 7 jika memilih BUMM (9999), Role 6 jika memilih Cabang
        $roleId     = ($cabangIdInput == '9999') ? 7 : 6;
        $cabangIdDb = ($cabangIdInput == '9999') ? 0 : $cabangIdInput;
        $pusat      = 7; // Default sesuai filter index

        if ($cabangIdInput != '9999') {
            $cabangData = $this->cabang->find($cabangIdInput);
            $pusat = $cabangData['pusat'] ?? 7;
        }

        $data = [
            'username'   => $this->request->getPost('username'),
            'nama'       => $this->request->getPost('nama'),
            'password'   => password_hash((string)$this->request->getPost('password'), PASSWORD_DEFAULT),
            'role_id'    => $roleId,
            'cabang_id'  => $cabangIdDb,
            'pusat'      => $pusat,
            'created_at' => date('Y-m-d H:i:s')
        ];

        if (!$userModel->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $userModel->errors());
        }

        return redirect()->to('/login')->with('success', 'Pendaftaran berhasil! Silahkan login.');
    }
}
