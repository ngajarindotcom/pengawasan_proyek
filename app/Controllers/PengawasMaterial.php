<?php

namespace App\Controllers;

use App\Models\FormMaterialModel;
use App\Models\ProyekModel;

class PengawasMaterial extends BaseController
{
    public function __construct()
    {
        $this->checkRole(['admin', 'pengawas_material']);
    }

    public function index()
    {
        $this->checkLogin();
        return redirect()->to('/pengawas-material/draft');
    }

    public function draft()
    {
        $formMaterialModel = new FormMaterialModel();
    $userId = $this->session->get('user_id');
    $role = $this->session->get('role');

    $forms = ($role === 'admin') 
        ? $formMaterialModel->getAllForms('draft')
        : $formMaterialModel->getFormsByUser($userId, 'draft');

    // Konversi object ke array
    $forms = array_map(function($item) {
        return (array)$item;
    }, $forms);

    $data = [
        'title' => 'Draft Form Material',
        'forms' => $forms,
    ];

    return view('pengawas_material/draft', $data);
    }

    public function terkirim()
    {
        $formMaterialModel = new FormMaterialModel();
    $userId = $this->session->get('user_id');
    $role = $this->session->get('role');

    $forms = ($role === 'admin') 
        ? $formMaterialModel->getAllForms('terkirim')
        : $formMaterialModel->getFormsByUser($userId, 'terkirim');

    // Konversi object ke array
    $forms = array_map(function($item) {
        return (array)$item;
    }, $forms);

    $data = [
        'title' => 'Form Material Terkirim',
        'forms' => $forms,
    ];

    return view('pengawas_material/terkirim', $data);
    }

    public function create()
    {
        $proyekModel = new ProyekModel();
    
    $data = [
        'title' => 'Buat Form Material',
        'proyek' => $proyekModel->findAll() // Ambil semua proyek
    ];

    return view('pengawas_material/create', $data);
    }

    public function store()
    {
        $proyekModel = new ProyekModel();
        $formMaterialModel = new FormMaterialModel();
        $rules = [
            'proyek_id' => [
            'label' => 'Proyek',
            'rules' => 'required|numeric|is_not_unique[proyek.id]',
            'errors' => [
                'is_not_unique' => 'Proyek yang dipilih tidak valid'
            ]
        ],
        'tanggal_pengawasan' => 'required|valid_date',
            'material_1' => 'permit_empty|numeric',
            'material_2' => 'permit_empty|numeric',
            'material_3' => 'permit_empty|numeric',
            'material_4' => 'permit_empty|numeric',
            'material_5' => 'permit_empty|numeric',
            'material_6' => 'permit_empty|numeric',
            'material_7' => 'permit_empty|numeric',
            'material_8' => 'permit_empty|numeric',
            'material_9' => 'permit_empty|numeric',
            'material_10' => 'permit_empty|numeric',
            'catatan' => 'permit_empty',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }

        $proyek = $proyekModel->find($this->request->getPost('proyek_id'));
    if (!$proyek) {
        return redirect()->back()->withInput()->with('error', 'Proyek tidak ditemukan');
    }


        // Handle file upload with compression
        $fotoMaterial = $this->uploadFoto('foto_material');
        $data = [
        'user_id' => $this->session->get('user_id'),
        'proyek_id' => $this->request->getPost('proyek_id'),
        'tanggal_pengawasan' => $this->request->getPost('tanggal_pengawasan'),
        'material_1' => $this->request->getPost('material_1'),
        'material_2' => $this->request->getPost('material_2'),
            'material_3' => $this->request->getPost('material_3'),
            'material_4' => $this->request->getPost('material_4'),
            'material_5' => $this->request->getPost('material_5'),
            'material_6' => $this->request->getPost('material_6'),
            'material_7' => $this->request->getPost('material_7'),
            'material_8' => $this->request->getPost('material_8'),
            'material_9' => $this->request->getPost('material_9'),
            'material_10' => $this->request->getPost('material_10'),
        
        'foto_material' => $fotoMaterial,
        'catatan' => $this->request->getPost('catatan'),
        'status' => 'draft'
    ];
$db = \Config\Database::connect();
    $db->transStart();

    try {
        $formMaterialModel->save($data);
        $db->transComplete();
        
        return redirect()->to('/pengawas-material/draft')->with('success', 'Form berhasil disimpan sebagai draft');
    } catch (\Exception $e) {
        $db->transRollback();
        return redirect()->back()->withInput()->with('error', 'Gagal menyimpan: '.$e->getMessage());
    }
}

    public function edit($id)
    {
        $formMaterialModel = new FormMaterialModel();
        $proyekModel = new ProyekModel();
        $form = $formMaterialModel->find($id);
        $userId = $this->session->get('user_id');
        $role = $this->session->get('role');

        // Check permission
        if ($role !== 'admin' && $form['user_id'] !== $userId) {
            return redirect()->to('/pengawas-material')->with('error', 'Anda tidak memiliki akses ke form ini');
        }

        $data = [
            'title' => 'Edit Form Material',
            'form' => $form,
            'proyek' => $proyekModel->findAll()
        ];

        return view('pengawas_material/edit', $data);
    }

    public function update($id)
    {
        $formMaterialModel = new FormMaterialModel();
        $form = $formMaterialModel->find($id);
        $userId = $this->session->get('user_id');
        $role = $this->session->get('role');

        // Check permission
        if ($role !== 'admin' && $form['user_id'] !== $userId) {
            return redirect()->to('/pengawas-material')->with('error', 'Anda tidak memiliki akses ke form ini');
        }

        $rules = [
            'proyek_id' => [
            'label' => 'Proyek',
            'rules' => 'required|numeric|is_not_unique[proyek.id]',
            'errors' => [
                'is_not_unique' => 'Proyek yang dipilih tidak valid'
            ]
        ],
        'tanggal_pengawasan' => 'required|valid_date',
            'material_1' => 'permit_empty|numeric',
            'material_2' => 'permit_empty|numeric',
            'material_3' => 'permit_empty|numeric',
            'material_4' => 'permit_empty|numeric',
            'material_5' => 'permit_empty|numeric',
            'material_6' => 'permit_empty|numeric',
            'material_7' => 'permit_empty|numeric',
            'material_8' => 'permit_empty|numeric',
            'material_9' => 'permit_empty|numeric',
            'material_10' => 'permit_empty|numeric',
            'catatan' => 'permit_empty',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }

        $data = [
            'proyek_id' => $this->request->getPost('proyek_id'),
        'tanggal_pengawasan' => $this->request->getPost('tanggal_pengawasan'),
            'material_1' => $this->request->getPost('material_1'),
            'material_2' => $this->request->getPost('material_2'),
            'material_3' => $this->request->getPost('material_3'),
            'material_4' => $this->request->getPost('material_4'),
            'material_5' => $this->request->getPost('material_5'),
            'material_6' => $this->request->getPost('material_6'),
            'material_7' => $this->request->getPost('material_7'),
            'material_8' => $this->request->getPost('material_8'),
            'material_9' => $this->request->getPost('material_9'),
            'material_10' => $this->request->getPost('material_10'),
            'catatan' => $this->request->getPost('catatan'),
        ];

        // Update file only if new one is uploaded
        if ($this->request->getFile('foto_material')->isValid()) {
            $data['foto_material'] = $this->uploadFoto('foto_material');
        }

        $formMaterialModel->update($id, $data);

        return redirect()->to('/pengawas-material/draft')->with('success', 'Form berhasil diperbarui');
    }

    public function kirim($id)
    {
        $formMaterialModel = new FormMaterialModel();
        $form = $formMaterialModel->find($id);
        $userId = $this->session->get('user_id');
        $role = $this->session->get('role');

        // Check permission
        if ($role !== 'admin' && $form['user_id'] !== $userId) {
            return redirect()->to('/pengawas-material')->with('error', 'Anda tidak memiliki akses ke form ini');
        }

        $formMaterialModel->update($id, ['status' => 'terkirim']);

        return redirect()->to('/pengawas-material/terkirim')->with('success', 'Form berhasil dikirim');
    }

    public function delete($id)
    {
        $formMaterialModel = new FormMaterialModel();
        $form = $formMaterialModel->find($id);
        $userId = $this->session->get('user_id');
        $role = $this->session->get('role');

        // Check permission
        if ($role !== 'admin' && $form['user_id'] !== $userId) {
            return redirect()->to('/pengawas-material')->with('error', 'Anda tidak memiliki akses ke form ini');
        }

        $formMaterialModel->delete($id);
        return redirect()->back()->with('success', 'Form berhasil dihapus');
    }

    public function view($id)
    {
        $formMaterialModel = new FormMaterialModel();
        $form = $formMaterialModel->find($id);
        $userId = $this->session->get('user_id');
        $role = $this->session->get('role');

        // Check permission
        if ($role !== 'admin' && $form['user_id'] !== $userId) {
            return redirect()->to('/pengawas-material')->with('error', 'Anda tidak memiliki akses ke form ini');
        }

        $data = [
            'title' => 'Detail Form Material',
            'form' => $form,
        ];

        return view('pengawas_material/view', $data);
    }

    private function uploadFoto($fieldName)
    {
        $file = $this->request->getFile($fieldName);

        if (!$file->isValid()) {
            return null;
        }

        // Validate image
        if (!in_array($file->getClientMimeType(), ['image/jpeg', 'image/png', 'image/jpg'])) {
            return null;
        }

        // Compress image to max 2MB
        $image = \Config\Services::image()
            ->withFile($file->getRealPath())
            ->resize(1024, 768, true, 'height');

        $newName = $file->getRandomName();
        $path = FCPATH . 'uploads/material/';

        // Ensure directory exists
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $image->save($path . $newName, 80); // 80% quality

        return $newName;
    }

    public function all()
{
    $formMaterialModel = new FormMaterialModel();
    
    $forms = $formMaterialModel  // Perbaikan: gunakan variabel yang benar
        ->select('form_material.*, users.nama_lengkap, proyek.nama_proyek')
        ->join('users', 'users.id = form_material.user_id')
        ->join('proyek', 'proyek.id = form_material.proyek_id')
        ->orderBy('form_material.created_at', 'DESC')
        ->findAll();

    $data = [
        'title' => 'Semua Form Material',
        'forms' => $forms
    ];

    return view('pengawas_material/all', $data);
}

   
}