<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Services\AuthService;

class LoginController extends BaseController
{
    protected AuthService $auth;

    public function __construct()
    {
        $this->auth = new AuthService();
    }

    public function index()
    {
        // ⛔ jika sudah login, jangan kembali ke login
        if (session()->get('is_login') === true) {
            return redirect()->to('/dashboard');
        }

        return view('auth/login');
    }

    public function authenticate()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        if (!$this->auth->attempt($username, $password)) {
            return redirect()->back()->with('error', 'Username atau password salah');
        }

        // ✅ VALIDASI SESSION WAJIB
        if (
            ! session()->has('user') ||
            ! isset(session()->get('user')['role_id'])
        ) {
            session()->destroy();
            return redirect()->to('/login')->with('error', 'Session tidak valid');
        }

        $roleId = session()->get('user')['role_id'];

        return match ((int) $roleId) {
            1 => redirect()->to('/admin'),          // superadmin
            6 => redirect()->to('/cabang/dashboard'),   // admin cabang
            default => $this->logout(),                 // ⛔ role tidak dikenal
        };
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
