<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CabangModel;
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

    public function checkAccess()
    {
        $input = $this->request->getPost('access_password');
        $real  = $this->setting->getValue('access_password');

        if ($input === $real) {
            session()->set('register_access', true);
            return redirect()->to('/register');
        }

        return redirect()->back()->with('error', 'Password salah');
    }
}
