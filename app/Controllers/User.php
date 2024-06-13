<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RedirectResponse;

class User extends Controller
{    
    public function index(): string
    {
        $model = new UserModel();
        $data['user'] = $model->findAll();

        $judul['title'] = 'Data Pengguna';
        echo view('layout/header', $judul);
        echo view('layout/lib', $judul);
        echo view('layout/sidebar', $judul);
        echo view('user/index', $data);
        return view('layout/footer');
    }

    public function create(): string
    {
        $judul['title'] = 'Tambah Pengguna';
        echo view('layout/header', $judul);
        echo view('layout/lib', $judul);
        echo view('layout/sidebar', $judul);
        return view('user/create') . view('layout/footer');
    }

    public function store(): RedirectResponse
    {
        $model = new UserModel();

        $data = [
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role')
        ];

        $model->insert($data);

        return redirect()->to(base_url('user'));
    }

    public function edit(int $id): string
    {
        $model = new UserModel();
        $data['user'] = $model->find($id);

        $judul['title'] = 'Edit Pengguna';
        echo view('layout/header', $judul);
        echo view('layout/lib', $judul);
        echo view('layout/sidebar', $judul);
        return view('user/edit', $data) . view('layout/footer');
    }

    public function update(int $id): RedirectResponse
    {
        $model = new UserModel();

        $data = [
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role')
        ];

        $model->update($id, $data);

        return redirect()->to(base_url('user'));
    }

    public function delete(int $id): RedirectResponse
    {
        $model = new UserModel();
        $model->delete($id);

        return redirect()->to(base_url('user'));
    }
}
