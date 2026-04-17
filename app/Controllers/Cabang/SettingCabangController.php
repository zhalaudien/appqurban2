<?php

namespace App\Controllers\Cabang;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\SettingCabangModel;
use App\Models\UserModel;

class SettingCabangController extends BaseController
{
    protected SettingCabangModel $SettingModel;
    protected UserModel $userModel;
    protected int $cabangId;
    protected int $userId;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->SettingModel = new SettingCabangModel();
        $this->userModel = new UserModel();
        $this->cabangId = session()->get('user')['cabang_id'] ?? 0;
        $this->userId = session()->get('user')['id'] ?? 0;
    }

    public function index()
    {
        if (!$this->cabangId) {
            return redirect()->to('/login');
        }

        $data = [
            'title'  => 'Pengaturan Profil Cabang',
            'profil' => $this->SettingModel->where('cabang_id', $this->cabangId)->first(),
            'user'   => $this->userModel->find($this->userId)
        ];

        return view('cabang/setting/index', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        $data = [
            'cabang_id'    => $this->cabangId,
            'alamat'       => $this->request->getPost('alamat'),
            'ketua'        => $this->request->getPost('ketua'),
            'ketua_hp'     => $this->request->getPost('ketua_hp'),
            'panitia_nama' => $this->request->getPost('panitia_nama'),
            'panitia_hp'   => $this->request->getPost('panitia_hp'),
            'it_nama'      => $this->request->getPost('it_nama'),
            'it_hp'        => $this->request->getPost('it_hp'),
            'perwakilan'   => $this->request->getPost('perwakilan'),
            'updated_at'   => date('Y-m-d H:i:s')
        ];

        if ($id) {
            $this->SettingModel->update($id, $data);
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $this->SettingModel->insert($data);
        }

        // Update Data User (Akun Login)
        $userData = [
            'username' => $this->request->getPost('username'),
            'nama'     => $this->request->getPost('nama_user'),
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $userData['password'] = $password;
        }

        $this->userModel->update($this->userId, $userData);

        return redirect()->back()->with('success', 'Profil dan akun cabang berhasil diperbarui');
    }
}
