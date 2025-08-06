<?php

namespace App\Controllers;

use App\Models\FormLapanganModel;
use App\Models\FormMaterialModel;
use App\Models\UserModel;

class Report extends BaseController
{
    public function __construct()
    {
        $this->checkRole(['admin']);
    }

    public function index()
    {
        $this->checkLogin();
        return redirect()->to('/report/lapangan');
    }

    public function lapangan()
    {
        $formLapanganModel = new FormLapanganModel();
        $userModel = new UserModel();

        // Filter parameters
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');
        $userId = $this->request->getGet('user_id');

        $builder = $formLapanganModel->select('form_lapangan.*, users.nama_lengkap, proyek.nama_proyek')
            ->join('users', 'users.id = form_lapangan.user_id')
            ->join('proyek', 'proyek.id = form_lapangan.proyek_id')
            ->where('form_lapangan.status', 'terkirim');

        if ($startDate) {
            $builder->where('form_lapangan.tanggal_pengawasan >=', $startDate);
        }

        if ($endDate) {
            $builder->where('form_lapangan.tanggal_pengawasan <=', $endDate);
        }

        if ($userId) {
            $builder->where('form_lapangan.user_id', $userId);
        }

        $forms = $builder->orderBy('form_lapangan.tanggal_pengawasan', 'DESC')->findAll();

        // Prepare data for charts
        $chartData = $this->prepareLapanganChartData($forms);

        $data = [
            'title' => 'Laporan Pengawasan Lapangan',
            'forms' => $forms,
            'users' => $userModel->where('role', 'pengawas_lapangan')->findAll(),
            'chartData' => $chartData,
            'filter' => [
                'start_date' => $startDate,
                'end_date' => $endDate,
                'user_id' => $userId,
            ],
        ];

        return view('report/lapangan', $data);
    }

    public function material()
    {
        $formMaterialModel = new FormMaterialModel();
        $userModel = new UserModel();

        // Filter parameters
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');
        $userId = $this->request->getGet('user_id');

        $builder = $formMaterialModel->select('form_material.*, users.nama_lengkap')
            ->join('users', 'users.id = form_material.user_id')
            ->where('form_material.status', 'terkirim');

        if ($startDate) {
            $builder->where('DATE(form_material.created_at) >=', $startDate);
        }

        if ($endDate) {
            $builder->where('DATE(form_material.created_at) <=', $endDate);
        }

        if ($userId) {
            $builder->where('form_material.user_id', $userId);
        }

        $forms = $builder->orderBy('form_material.created_at', 'DESC')->findAll();

        // Prepare data for charts
        $chartData = $this->prepareMaterialChartData($forms);

        $data = [
            'title' => 'Laporan Pengawasan Material',
            'forms' => $forms,
            'users' => $userModel->where('role', 'pengawas_material')->findAll(),
            'chartData' => $chartData,
            'filter' => [
                'start_date' => $startDate,
                'end_date' => $endDate,
                'user_id' => $userId,
            ],
        ];

        return view('report/material', $data);
    }

    public function exportLapanganPdf()
    {
        $formLapanganModel = new FormLapanganModel();

        // Filter parameters
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');
        $userId = $this->request->getGet('user_id');

        $builder = $formLapanganModel->select('form_lapangan.*, users.nama_lengkap, proyek.nama_proyek')
            ->join('users', 'users.id = form_lapangan.user_id')
            ->join('proyek', 'proyek.id = form_lapangan.proyek_id')
            ->where('form_lapangan.status', 'terkirim');

        if ($startDate) {
            $builder->where('form_lapangan.tanggal_pengawasan >=', $startDate);
        }

        if ($endDate) {
            $builder->where('form_lapangan.tanggal_pengawasan <=', $endDate);
        }

        if ($userId) {
            $builder->where('form_lapangan.user_id', $userId);
        }

        $forms = $builder->orderBy('form_lapangan.tanggal_pengawasan', 'DESC')->findAll();

        $data = [
            'title' => 'Laporan Pengawasan Lapangan',
            'forms' => $forms,
            'filter' => [
                'start_date' => $startDate,
                'end_date' => $endDate,
                'user_id' => $userId,
            ],
        ];

        $html = view('report/export_lapangan_pdf', $data);

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('laporan-pengawasan-lapangan.pdf', ['Attachment' => false]);
    }

    public function exportMaterialPdf()
    {
        $formMaterialModel = new FormMaterialModel();

        // Filter parameters
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');
        $userId = $this->request->getGet('user_id');

        $builder = $formMaterialModel->select('form_material.*, users.nama_lengkap')
            ->join('users', 'users.id = form_material.user_id')
            ->where('form_material.status', 'terkirim');

        if ($startDate) {
            $builder->where('DATE(form_material.created_at) >=', $startDate);
        }

        if ($endDate) {
            $builder->where('DATE(form_material.created_at) <=', $endDate);
        }

        if ($userId) {
            $builder->where('form_material.user_id', $userId);
        }

        $forms = $builder->orderBy('form_material.created_at', 'DESC')->findAll();

        $data = [
            'title' => 'Laporan Pengawasan Material',
            'forms' => $forms,
            'filter' => [
                'start_date' => $startDate,
                'end_date' => $endDate,
                'user_id' => $userId,
            ],
        ];

        $html = view('report/export_material_pdf', $data);

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('laporan-pengawasan-material.pdf', ['Attachment' => false]);
    }

    private function prepareLapanganChartData($forms)
    {
        $chartData = [
            'cuaca' => [
                'Cerah' => 0,
                'Hujan' => 0,
                'Mendung' => 0,
            ],
            'k3' => [
                'Diterapkan' => 0,
                'Tidak Diterapkan' => 0,
            ],
            'material' => [
                'Cukup' => 0,
                'Kurang' => 0,
                'Rusak' => 0,
            ],
            'alat' => [
                'Tersedia' => 0,
                'Tidak Tersedia' => 0,
            ],
        ];

        foreach ($forms as $form) {
            $chartData['cuaca'][$form['status_cuaca']]++;
            $chartData['k3'][$form['penerapan_sop_k3']]++;
            $chartData['material'][$form['kondisi_material']]++;
            $chartData['alat'][$form['ketersediaan_alat']]++;
        }

        return $chartData;
    }

    private function prepareMaterialChartData($forms)
    {
        $chartData = [
            'material_1' => [],
            'material_2' => [],
            'material_3' => [],
            'material_4' => [],
            'material_5' => [],
            'material_6' => [],
            'material_7' => [],
            'material_8' => [],
            'material_9' => [],
            'material_10' => [],
        ];

        foreach ($forms as $form) {
            foreach ($chartData as $key => $value) {
                if (!empty($form[$key])) {
                    $chartData[$key][] = $form[$key];
                }
            }
        }

        // Calculate averages
        $averages = [];
        foreach ($chartData as $key => $values) {
            if (!empty($values)) {
                $averages[$key] = array_sum($values) / count($values);
            } else {
                $averages[$key] = 0;
            }
        }

        return $averages;
    }
}