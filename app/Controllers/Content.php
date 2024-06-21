<?php

namespace App\Controllers;

use App\Models\ContentModel;
use CodeIgniter\Controller;
use App\helpers\date_helper;
use CodeIgniter\HTTP\RedirectResponse;

class Content extends Controller
{
    public function index(): string
    {
        $model = new ContentModel();
        $data['contents'] = $model->findAll();

        $judul['title'] = 'Data Konten';
        echo view('layout/header', $judul);
        echo view('layout/lib', $judul);
        echo view('layout/sidebar', $judul);
        echo view('content/index', $data);
        return view('layout/footer');
    }

    public function create(): string
    {
        $judul['title'] = 'Tambah Konten';
        echo view('layout/header', $judul);
        echo view('layout/lib', $judul);
        echo view('layout/sidebar', $judul);
        return view('content/create') . view('layout/footer');
    }

    public function store(): RedirectResponse
    {
        // Validasi input
        if (!$this->validate([
            'foto' => [
                'rules'  => 'uploaded[foto]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Foto buku harus dipilih.',
                    'is_image' => 'Yang Anda pilih bukan gambar.',
                    'mime_in'  => 'Foto buku harus berekstensi png, jpg, atau gif.'
                ]
            ]
        ])) {
            return redirect()->to('content/create')->withInput();
        }
    
        // Ambil file foto dari request
        $file = $this->request->getFile('foto');
    
        // Pindahkan file ke dalam folder uploads
        $newName = $file->getRandomName();
        if (!$file->move(ROOTPATH . 'public/uploads/content', $newName)) {
            log_message('error', 'File move error: ' . $file->getErrorString());
            return redirect()->back()->withInput()->with('errors', 'File upload failed');
        }
        
        // Simpan data ke dalam database
        $model = new ContentModel();
        $data = [
            'judul'     => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'subtittle' => $this->request->getPost('subtittle'),
            'tanggal'   => $this->request->getPost('tanggal'),
            'foto'      => $newName,
        ];
    
        if ($model->insert($data) === false) {
            log_message('error', 'Database insert error: ' . json_encode($model->errors()));
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }
    
        return redirect()->to(base_url('content'));
    }
    


    public function read(int $id): string
    {
        $model = new ContentModel();
        $data['content'] = $model->find($id);
        $data['title'] = 'Detail Konten';

        echo view('layout/header', $data);
        echo view('layout/lib', $data);
        echo view('layout/sidebar', $data);
        return view('content/read', $data) . view('layout/footer');
    }
    
    public function edit(int $id): string
    {
        $model = new ContentModel();
        $data['content'] = $model->find($id);

        if (!$data['content']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Content with ID $id not found");
        }

        $judul['title'] = 'Edit Konten';
        echo view('layout/header', $judul);
        echo view('layout/lib', $judul);
        echo view('layout/sidebar', $judul);
        return view('content/edit', $data);
    }

    public function update(int $id): RedirectResponse
    {
        $model = new ContentModel();

        $data = [
            'judul'     => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'subtittle' => $this->request->getPost('subtittle'),
            'tanggal'   => $this->request->getPost('tanggal'),
            
        ];

        if ($this->request->getFile('foto')->isValid()) {
            $file = $this->request->getFile('foto');
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move(ROOTPATH . 'public/uploads/content', $newName);
                $data['foto'] = $newName;
            } else {
                return redirect()->back()->withInput()->with('errors', $file->getErrorString());
            }
        }

        if ($model->update($id, $data) === false) {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }

        return redirect()->to(base_url('content'));
    }

    public function delete(int $id): RedirectResponse
    {
        $model = new ContentModel();
        $content = $model->find($id);

        if ($content) {
            // Delete the file
            $filePath = WRITEPATH . 'uploads/' . $content['foto'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            $model->delete($id);
        }

        return redirect()->to(base_url('content'));
    }
}
