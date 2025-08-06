<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Detail Form Pengawasan Material</h3>
        <div class="card-tools">
            <?php if ($form['status'] === 'draft'): ?>
                <a href="<?= site_url('pengawas-material/kirim/' . $form['id']) ?>" class="btn btn-success btn-sm" onclick="return confirm('Kirim form ini?')">
                    <i class="fas fa-paper-plane"></i> Kirim Form
                </a>
            <?php endif; ?>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Material 1</label>
                    <p class="form-control-static"><?= $form['material_1'] ?? '-' ?></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Material 2</label>
                    <p class="form-control-static"><?= $form['material_2'] ?? '-' ?></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Material 3</label>
                    <p class="form-control-static"><?= $form['material_3'] ?? '-' ?></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Material 4</label>
                    <p class="form-control-static"><?= $form['material_4'] ?? '-' ?></p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Material 5</label>
                    <p class="form-control-static"><?= $form['material_5'] ?? '-' ?></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Material 6</label>
                    <p class="form-control-static"><?= $form['material_6'] ?? '-' ?></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Material 7</label>
                    <p class="form-control-static"><?= $form['material_7'] ?? '-' ?></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Material 8</label>
                    <p class="form-control-static"><?= $form['material_8'] ?? '-' ?></p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Material 9</label>
                    <p class="form-control-static"><?= $form['material_9'] ?? '-' ?></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Material 10</label>
                    <p class="form-control-static"><?= $form['material_10'] ?? '-' ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <?php if ($form['foto_material']): ?>
                <div class="form-group">
                    <label>Foto Material</label>
                    <div>
                        <a href="<?= base_url('uploads/material/' . $form['foto_material']) ?>" target="_blank">
                            <img src="<?= base_url('uploads/material/' . $form['foto_material']) ?>" class="img-fluid" alt="Foto Material">
                        </a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
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
        <a href="<?= site_url('pengawas-material/' . ($form['status'] === 'terkirim' ? 'terkirim' : 'draft')) ?>" class="btn btn-default">Kembali</a>
    </div>
</div>
<!-- /.card -->
<?= $this->endSection() ?>