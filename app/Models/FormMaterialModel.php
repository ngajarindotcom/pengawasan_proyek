<?php

namespace App\Models;

use CodeIgniter\Model;

class FormMaterialModel extends Model
{
    protected $table = 'form_material';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'proyek_id', 'tanggal_pengawasan', 'user_id', 'material_1', 'material_2', 'material_3', 'material_4', 
        'material_5', 'material_6', 'material_7', 'material_8', 'material_9', 
        'material_10', 'foto_material', 'catatan', 'status'
    ];

    public function getFormsByUser($userId, $status = null)
    {
        $builder = $this->db->table($this->table)
            ->select('form_material.*, users.nama_lengkap')
            ->join('users', 'users.id = form_material.user_id')
            ->where('form_material.user_id', $userId);

        if ($status) {
            $builder->where('form_material.status', $status);
        }

        return $builder->get()->getResult();
    }

    public function getAllForms($status = null)
    {
        $builder = $this->db->table($this->table)
            ->select('form_material.*, users.nama_lengkap')
            ->join('users', 'users.id = form_material.user_id');

        if ($status) {
            $builder->where('form_material.status', $status);
        }

        return $builder->get()->getResult();
    }

public function all()
{
    $formMaterialModel = new FormMaterialModel();
    
    $forms = $formMaterialModel
        ->select('form_material.*, users.nama_lengkap, proyek.nama_proyek')
        ->join('users', 'users.id = form_material.user_id')
        ->join('proyek', 'proyek.id = form_material.proyek_id')
        ->orderBy('form_material.created_at', 'DESC')
        ->findAll();

    // Konversi eksplisit ke array jika diperlukan
    // $forms = array_map(function($item) { return (array)$item; }, $forms);

    $data = [
        'title' => 'Semua Form Material',
        'forms' => $forms
    ];

    return view('pengawas_material/all', $data);
}

}