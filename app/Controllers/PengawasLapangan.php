<?php

namespace App\Controllers;

use App\Models\FormLapanganModel;
use App\Models\ProyekModel;

class PengawasLapangan extends BaseController
{
    public function __construct()
    {
        $this->checkRole(['admin', 'pengawas_lapangan']);
    }

    public function index()
    {
        $this->checkLogin();
        return redirect()->to('/pengawas-lapangan/draft');
    }

    public function draft()
    {
        $formLapanganModel = new FormLapanganModel();
        $userId = $this->session->get('user_id');
        $role = $this->session->get('role');

        $forms = ($role === 'admin') 
            ? $formLapanganModel->getAllForms('draft')
            : $formLapanganModel->getFormsByUser($userId, 'draft');

            

        $data = [
            'title' => 'Draft Form Lapangan',
            'forms' => $forms,
        ];

        $forms = $formLapanganModel->getFormsByUser($userId, 'draft');
$data['forms'] = array_map(function($item) {
    return (array)$item;
}, $forms);

        return view('pengawas_lapangan/draft', $data);
    }

    public function terkirim()
    {
        $formLapanganModel = new FormLapanganModel();
        $userId = $this->session->get('user_id');
        $role = $this->session->get('role');

        $forms = ($role === 'admin') 
            ? $formLapanganModel->getAllForms('terkirim')
            : $formLapanganModel->getFormsByUser($userId, 'terkirim');

        $data = [
            'title' => 'Form Lapangan Terkirim',
            'forms' => $forms,
        ];
        $forms = $formLapanganModel->getFormsByUser($userId, 'terkirim');
$data['forms'] = array_map(function($item) {
    return (array)$item;
}, $forms);

        return view('pengawas_lapangan/terkirim', $data);
    }

    public function create()
    {
        $proyekModel = new ProyekModel();
        
        $data = [
            'title' => 'Buat Form Lapangan',
            'proyek' => $proyekModel->findAll(),
        ];

        return view('pengawas_lapangan/create', $data);
    }

    public function store()
    {
        $rules = [
            'proyek_id' => 'required',
            'tanggal_pengawasan' => 'required|valid_date',
            'status_cuaca' => 'required|in_list[Cerah,Hujan,Mendung]',
            'pekerjaan_dilakukan' => 'required',
            'jumlah_pekerja' => 'required|numeric',
            'kondisi_material' => 'required|in_list[Cukup,Kurang,Rusak]',
            'ketersediaan_alat' => 'required|in_list[Tersedia,Tidak Tersedia]',
            'penerapan_sop_k3' => 'required|in_list[Diterapkan,Tidak Diterapkan]',
            'catatan' => 'permit_empty',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }

        // Handle file uploads with compression
        $fotoToolbox = $this->uploadFoto('foto_toolbox');
        $fotoCheckup = $this->uploadFoto('foto_checkup');
        $fotoPelaksanaan = $this->uploadFoto('foto_pelaksanaan');
        $fotoAlatBahan = $this->uploadFoto('foto_alat_bahan');

        $formLapanganModel = new FormLapanganModel();
        $formLapanganModel->save([
            'user_id' => $this->session->get('user_id'),
            'proyek_id' => $this->request->getPost('proyek_id'),
            'tanggal_pengawasan' => $this->request->getPost('tanggal_pengawasan'),
            'status_cuaca' => $this->request->getPost('status_cuaca'),
            'pekerjaan_dilakukan' => $this->request->getPost('pekerjaan_dilakukan'),
            'jumlah_pekerja' => $this->request->getPost('jumlah_pekerja'),
            'kondisi_material' => $this->request->getPost('kondisi_material'),
            'ketersediaan_alat' => $this->request->getPost('ketersediaan_alat'),
            'penerapan_sop_k3' => $this->request->getPost('penerapan_sop_k3'),
            'foto_toolbox' => $fotoToolbox,
            'foto_checkup' => $fotoCheckup,
            'foto_pelaksanaan' => $fotoPelaksanaan,
            'foto_alat_bahan' => $fotoAlatBahan,
            'catatan' => $this->request->getPost('catatan'),
            'status' => 'draft',
        ]);

        return redirect()->to('/pengawas-lapangan/draft')->with('success', 'Form berhasil disimpan sebagai draft');
    }

    public function edit($id)
    {
        $formLapanganModel = new FormLapanganModel();
        $proyekModel = new ProyekModel();
        
        $form = $formLapanganModel->find($id);
        $userId = $this->session->get('user_id');
        $role = $this->session->get('role');

        // Check permission
        if ($role !== 'admin' && $form['user_id'] !== $userId) {
            return redirect()->to('/pengawas-lapangan')->with('error', 'Anda tidak memiliki akses ke form ini');
        }

        $data = [
            'title' => 'Edit Form Lapangan',
            'form' => $form,
            'proyek' => $proyekModel->findAll(),
        ];

        return view('pengawas_lapangan/edit', $data);
    }

    public function update($id)
    {
        $formLapanganModel = new FormLapanganModel();
        $form = $formLapanganModel->find($id);
        $userId = $this->session->get('user_id');
        $role = $this->session->get('role');

        // Check permission
        if ($role !== 'admin' && $form['user_id'] !== $userId) {
            return redirect()->to('/pengawas-lapangan')->with('error', 'Anda tidak memiliki akses ke form ini');
        }

        $rules = [
            'proyek_id' => 'required',
            'tanggal_pengawasan' => 'required|valid_date',
            'status_cuaca' => 'required|in_list[Cerah,Hujan,Mendung]',
            'pekerjaan_dilakukan' => 'required',
            'jumlah_pekerja' => 'required|numeric',
            'kondisi_material' => 'required|in_list[Cukup,Kurang,Rusak]',
            'ketersediaan_alat' => 'required|in_list[Tersedia,Tidak Tersedia]',
            'penerapan_sop_k3' => 'required|in_list[Diterapkan,Tidak Diterapkan]',
            'catatan' => 'permit_empty',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }

        // Handle file uploads with compression
        $data = [
            'proyek_id' => $this->request->getPost('proyek_id'),
            'tanggal_pengawasan' => $this->request->getPost('tanggal_pengawasan'),
            'status_cuaca' => $this->request->getPost('status_cuaca'),
            'pekerjaan_dilakukan' => $this->request->getPost('pekerjaan_dilakukan'),
            'jumlah_pekerja' => $this->request->getPost('jumlah_pekerja'),
            'kondisi_material' => $this->request->getPost('kondisi_material'),
            'ketersediaan_alat' => $this->request->getPost('ketersediaan_alat'),
            'penerapan_sop_k3' => $this->request->getPost('penerapan_sop_k3'),
            'catatan' => $this->request->getPost('catatan'),
        ];

        // Update files only if new ones are uploaded
        if ($this->request->getFile('foto_toolbox')->isValid()) {
            $data['foto_toolbox'] = $this->uploadFoto('foto_toolbox');
        }

        if ($this->request->getFile('foto_checkup')->isValid()) {
            $data['foto_checkup'] = $this->uploadFoto('foto_checkup');
        }

        if ($this->request->getFile('foto_pelaksanaan')->isValid()) {
            $data['foto_pelaksanaan'] = $this->uploadFoto('foto_pelaksanaan');
        }

        if ($this->request->getFile('foto_alat_bahan')->isValid()) {
            $data['foto_alat_bahan'] = $this->uploadFoto('foto_alat_bahan');
        }

        $formLapanganModel->update($id, $data);

        return redirect()->to('/pengawas-lapangan/draft')->with('success', 'Form berhasil diperbarui');
    }

    public function kirim($id)
    {
        $formLapanganModel = new FormLapanganModel();
        $form = $formLapanganModel->find($id);
        $userId = $this->session->get('user_id');
        $role = $this->session->get('role');

        // Check permission
        if ($role !== 'admin' && $form['user_id'] !== $userId) {
            return redirect()->to('/pengawas-lapangan')->with('error', 'Anda tidak memiliki akses ke form ini');
        }

        $formLapanganModel->update($id, ['status' => 'terkirim']);

        return redirect()->to('/pengawas-lapangan/terkirim')->with('success', 'Form berhasil dikirim');
    }

    public function delete($id)
    {
        $formLapanganModel = new FormLapanganModel();
        $form = $formLapanganModel->find($id);
        $userId = $this->session->get('user_id');
        $role = $this->session->get('role');

        // Check permission
        if ($role !== 'admin' && $form['user_id'] !== $userId) {
            return redirect()->to('/pengawas-lapangan')->with('error', 'Anda tidak memiliki akses ke form ini');
        }

        $formLapanganModel->delete($id);
        return redirect()->back()->with('success', 'Form berhasil dihapus');
    }

    public function view($id)
    {
       $formLapanganModel = new FormLapanganModel();
    $form = $formLapanganModel->select('form_lapangan.*, proyek.nama_proyek')
                             ->join('proyek', 'proyek.id = form_lapangan.proyek_id')
                             ->find($id);

    if (!$form) {
        return redirect()->back()->with('error', 'Form tidak ditemukan');
    }

    $data = [
        'title' => 'Detail Form Lapangan',
        'form' => $form
    ];

    return view('pengawas_lapangan/view', $data);
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
        $path = FCPATH . 'uploads/lapangan/';

        // Ensure directory exists
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $image->save($path . $newName, 80); // 80% quality

        return $newName;
    }

    public function all()
{
    $formLapanganModel = new FormLapanganModel();
    $forms = $formLapanganModel->select('form_lapangan.*, users.nama_lengkap, proyek.nama_proyek')
        ->join('users', 'users.id = form_lapangan.user_id')
        ->join('proyek', 'proyek.id = form_lapangan.proyek_id')
        ->whereIn('form_lapangan.status', ['draft', 'terkirim'])
        ->orderBy('form_lapangan.created_at', 'DESC')
        ->findAll();

    $data = [
        'title' => 'Semua Form Lapangan',
        'forms' => $forms,
    ];
   

    return view('pengawas_lapangan/all', $data);
}
}