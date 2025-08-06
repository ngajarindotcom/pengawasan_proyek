<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Detail Form Pengawasan Lapangan</h3>
        <div class="card-tools">
            <?php if ($form['status'] === 'draft'): ?>
                <a href="<?= site_url('pengawas-lapangan/kirim/' . $form['id']) ?>" class="btn btn-success btn-sm" onclick="return confirm('Kirim form ini?')">
                    <i class="fas fa-paper-plane"></i> Kirim Form
                </a>
            <?php endif; ?>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nama Proyek</label>
                    <p class="form-control-static"><?= $form['nama_proyek'] ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tanggal Pengawasan</label>
                    <p class="form-control-static"><?= date('d/m/Y', strtotime($form['tanggal_pengawasan'])) ?></p>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Status Cuaca</label>
            <p class="form-control-static"><?= $form['status_cuaca'] ?></p>
        </div>

        <div class="form-group">
            <label>Pekerjaan yang Dilakukan</label>
            <p class="form-control-static"><?= $form['pekerjaan_dilakukan'] ?></p>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Jumlah Pekerja yang Hadir</label>
                    <p class="form-control-static"><?= $form['jumlah_pekerja'] ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Kondisi Material</label>
                    <p class="form-control-static"><?= $form['kondisi_material'] ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Ketersediaan Alat</label>
                    <p class="form-control-static"><?= $form['ketersediaan_alat'] ?></p>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Penerapan SOP K3</label>
            <p class="form-control-static"><?= $form['penerapan_sop_k3'] ?></p>
        </div>

        <div class="row">
            <?php if ($form['foto_toolbox']): ?>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Foto Toolbox Meeting</label>
                    <div>
                        <a href="<?= base_url('uploads/lapangan/' . $form['foto_toolbox']) ?>" target="_blank">
                            <img src="<?= base_url('uploads/lapangan/' . $form['foto_toolbox']) ?>" class="img-fluid" alt="Foto Toolbox Meeting">
                        </a>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($form['foto_checkup']): ?>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Foto Checkup Pekerja</label>
                    <div>
                        <a href="<?= base_url('uploads/lapangan/' . $form['foto_checkup']) ?>" target="_blank">
                            <img src="<?= base_url('uploads/lapangan/' . $form['foto_checkup']) ?>" class="img-fluid" alt="Foto Checkup Pekerja">
                        </a>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($form['foto_pelaksanaan']): ?>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Foto Pelaksanaan Pekerjaan</label>
                    <div>
                        <a href="<?= base_url('uploads/lapangan/' . $form['foto_pelaksanaan']) ?>" target="_blank">
                            <img src="<?= base_url('uploads/lapangan/' . $form['foto_pelaksanaan']) ?>" class="img-fluid" alt="Foto Pelaksanaan Pekerjaan">
                        </a>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($form['foto_alat_bahan']): ?>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Foto Alat dan Bahan</label>
                    <div>
                        <a href="<?= base_url('uploads/lapangan/' . $form['foto_alat_bahan']) ?>" target="_blank">
                            <img src="<?= base_url('uploads/lapangan/' . $form['foto_alat_bahan']) ?>" class="img-fluid" alt="Foto Alat dan Bahan">
                        </a>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <?php if ($form['catatan']): ?>
        <div class="form-group">
            <label>Catatan</label>
            <p class="form-control-static"><?= $form['catatan'] ?></p>
        </div>
        <?php endif; ?>

        <div class="form-group">
            <label>Status</label>
            <p class="form-control-static">
                <span class="badge <?= $form['status'] === 'terkirim' ? 'bg-success' : 'bg-warning' ?>">
                    <?= ucfirst($form['status']) ?>
                </span>
            </p>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <a href="<?= site_url('pengawas-lapangan/' . ($form['status'] === 'terkirim' ? 'terkirim' : 'draft')) ?>" class="btn btn-default">Kembali</a>
    </div>
</div>
<!-- /.card -->
<?= $this->endSection() ?>