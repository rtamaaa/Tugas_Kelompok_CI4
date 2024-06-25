<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RedirectResponse;

class Auth extends Controller
{
    public function login(): string
    {
        $judul['title'] = 'Login';
        return view('auth/login', $judul);
    }

    public function authenticate(): RedirectResponse
    {
        $model = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        
        $user = $model->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            $session = session();
            $session->set([
                'username' => $user['username'],
                'role' => $user['role'],
                'isLoggedIn' => true,
            ]);

            if ($user['role'] === 'admin') {
                return redirect()->to(base_url('user'));
            } else {
                return redirect()->to(base_url('content'));
            }
        } else {
            return redirect()->back()->with('error', 'Invalid Login');
        }
    }

    public function logout(): RedirectResponse
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}
