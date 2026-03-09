<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (! session()->has('user')) {
            return redirect()->to('/login');
        }

        $user = session()->get('user');

        if (! isset($user['role_id'])) {
            session()->destroy();
            return redirect()->to('/login');
        }

        $allowedRoles = array_map('intval', (array) $arguments);

        if (! in_array((int) $user['role_id'], $allowedRoles, true)) {
            return redirect()->to('/403');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // nothing
    }
}
