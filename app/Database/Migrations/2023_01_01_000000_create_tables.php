<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTables extends Migration
{
    public function up()
    {
        // Tabel Users
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'nama_lengkap' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'role' => [
                'type' => 'ENUM',
                'constraint' => ['admin', 'pengawas_lapangan', 'pengawas_material'],
                'default' => 'pengawas_lapangan',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');

        // Tabel Proyek
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_proyek' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'nama_pelaksana' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('proyek');

        // Tabel Form Lapangan
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'proyek_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'tanggal_pengawasan' => [
                'type' => 'DATE',
            ],
            'status_cuaca' => [
                'type' => 'ENUM',
                'constraint' => ['Cerah', 'Hujan', 'Mendung'],
            ],
            'pekerjaan_dilakukan' => [
                'type' => 'TEXT',
            ],
            'jumlah_pekerja' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'kondisi_material' => [
                'type' => 'ENUM',
                'constraint' => ['Cukup', 'Kurang', 'Rusak'],
            ],
            'ketersediaan_alat' => [
                'type' => 'ENUM',
                'constraint' => ['Tersedia', 'Tidak Tersedia'],
            ],
            'penerapan_sop_k3' => [
                'type' => 'ENUM',
                'constraint' => ['Diterapkan', 'Tidak Diterapkan'],
            ],
            'foto_toolbox' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'foto_checkup' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'foto_pelaksanaan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'foto_alat_bahan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'catatan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['draft', 'terkirim'],
                'default' => 'draft',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id');
        $this->forge->addForeignKey('proyek_id', 'proyek', 'id');
        $this->forge->createTable('form_lapangan');

        // Tabel Form Material
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'material_1' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'material_2' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'material_3' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'material_4' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'material_5' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'material_6' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'material_7' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'material_8' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'material_9' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'material_10' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'foto_material' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'catatan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['draft', 'terkirim'],
                'default' => 'draft',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id');
        $this->forge->createTable('form_material');
    }

    public function down()
    {
        $this->forge->dropTable('form_lapangan');
        $this->forge->dropTable('form_material');
        $this->forge->dropTable('proyek');
        $this->forge->dropTable('users');
    }
}