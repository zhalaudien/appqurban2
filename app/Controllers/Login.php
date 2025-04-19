<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;

class Login extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function loginProcess()
    {
        $session = session();
        $model = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            $session->set('isLoggedIn', true);
            $session->set('username', $user['username']);
            return redirect()->to('/admin');
        } else {
            $session->setFlashdata('msg', 'Invalid username or password');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}