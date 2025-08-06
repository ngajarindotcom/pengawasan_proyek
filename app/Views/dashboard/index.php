<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $total_form_lapangan ?? 0 ?></h3>
                <p>Form Lapangan</p>
            </div>
            <div class="icon">
                <i class="fas fa-hard-hat"></i>
            </div>
            <a href="<?= site_url('pengawas-lapangan') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= $total_form_material ?? 0 ?></h3>
                <p>Form Material</p>
            </div>
            <div class="icon">
                <i class="fas fa-boxes"></i>
            </div>
            <a href="<?= site_url('pengawas-material') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= $total_users ?? 0 ?></h3>
                <p>Total User</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="<?= site_url('users') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?= $total_proyek ?? 0 ?></h3>
                <p>Total Proyek</p>
            </div>
            <div class="icon">
                <i class="fas fa-building"></i>
            </div>
            <a href="<?= site_url('proyek') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>

<?php if (session()->get('role') === 'admin'): ?>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Lapangan Terbaru</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Proyek</th>
                            <th>Tanggal</th>
                            <th>Pengawas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($form_lapangan_terbaru as $form): ?>
                        <tr>
                            <td><?= $form['nama_proyek'] ?></td>
                            <td><?= date('d/m/Y', strtotime($form['tanggal_pengawasan'])) ?></td>
                            <td><?= $form['nama_lengkap'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Material Terbaru</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Pengawas</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($form_material_terbaru as $form): ?>
                        <tr>
                            <td><?= date('d/m/Y', strtotime($form['created_at'])) ?></td>
                            <td><?= $form['nama_lengkap'] ?></td>
                            <td><span class="badge bg-success"><?= ucfirst($form['status']) ?></span></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<?php endif; ?>
<?= $this->endSection() ?>