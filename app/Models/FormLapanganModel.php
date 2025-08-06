<?php

namespace App\Models;

use CodeIgniter\Model;

class FormLapanganModel extends Model
{
    protected $table = 'form_lapangan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id', 'proyek_id', 'tanggal_pengawasan', 'status_cuaca', 
        'pekerjaan_dilakukan', 'jumlah_pekerja', 'kondisi_material', 
        'ketersediaan_alat', 'penerapan_sop_k3', 'foto_toolbox', 
        'foto_checkup', 'foto_pelaksanaan', 'foto_alat_bahan', 'catatan', 'status'
    ];

    public function getFormsByUser($userId, $status = null)
    {
        $builder = $this->db->table($this->table)
            ->select('form_lapangan.*, users.nama_lengkap, proyek.nama_proyek')
            ->join('users', 'users.id = form_lapangan.user_id')
            ->join('proyek', 'proyek.id = form_lapangan.proyek_id')
            ->where('form_lapangan.user_id', $userId);

        if ($status) {
            $builder->where('form_lapangan.status', $status);
        }

        return $builder->get()->getResult();
    }

    public function getAllForms($status = null)
    {
        $builder = $this->db->table($this->table)
            ->select('form_lapangan.*, users.nama_lengkap, proyek.nama_proyek')
            ->join('users', 'users.id = form_lapangan.user_id')
            ->join('proyek', 'proyek.id = form_lapangan.proyek_id');

        if ($status) {
            $builder->where('form_lapangan.status', $status);
        }

        return $builder->get()->getResult();
    }
}