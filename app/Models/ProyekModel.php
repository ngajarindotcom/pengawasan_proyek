<?php

namespace App\Models;

use CodeIgniter\Model;

class ProyekModel extends Model
{
    protected $table = 'proyek';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_proyek', 'nama_pelaksana'];
}