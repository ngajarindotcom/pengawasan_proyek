<?php

namespace App\Controllers;

use App\Models\FormLapanganModel;
use App\Models\FormMaterialModel;
use App\Models\UserModel; 

class Dashboard extends BaseController
{
    public function index()
{
    $this->checkLogin();

    $data = ['title' => 'Dashboard'];

    if ($this->session->get('role') === 'admin') {
        $formLapanganModel = new FormLapanganModel();
        $formMaterialModel = new FormMaterialModel();
        $userModel = new UserModel();

        $data['form_lapangan_terbaru'] = $formLapanganModel
            ->select('form_lapangan.*, proyek.nama_proyek, users.nama_lengkap')
            ->join('proyek', 'proyek.id = form_lapangan.proyek_id')
            ->join('users', 'users.id = form_lapangan.user_id')
            ->where('form_lapangan.status', 'terkirim')
            ->orderBy('form_lapangan.created_at', 'DESC')
            ->limit(5)
            ->findAll();

        $data['form_material_terbaru'] = $formMaterialModel
            ->select('form_material.*, users.nama_lengkap')
            ->join('users', 'users.id = form_material.user_id')
            ->where('form_material.status', 'terkirim')
            ->orderBy('form_material.created_at', 'DESC')
            ->limit(5)
            ->findAll();
    }

    return view('dashboard/index', $data);
}
}