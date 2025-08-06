<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Form Pengawasan Material</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form action="<?= site_url('pengawas-material/update/' . $form['id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <div class="row">

                <div class="col-md-6">
                    <label>Proyek</label>
                    <select class="form-control" id="proyek_id" name="proyek_id" required>
                            <option value="">Pilih Proyek</option>
                            <?php foreach ($proyek as $p): ?>
                            <option value="<?= $p['id'] ?>" <?= $form['proyek_id'] == $p['id'] ? 'selected' : '' ?>><?= $p['nama_proyek'] ?></option>
                            <?php endforeach; ?>
                        </select>
                </div>

                <div class="col-md-6">
                    <label>Tanggal Pengawasan</label>
                    <input type="date" class="form-control" id="tanggal_pengawasan" name="tanggal_pengawasan" value="<?= $form['tanggal_pengawasan'] ?>" required>
                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        <label for="material_1">Material 1</label>
                        <input type="number" class="form-control" id="material_1" name="material_1" value="<?= $form['material_1'] ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="material_2">Material 2</label>
                        <input type="number" class="form-control" id="material_2" name="material_2" value="<?= $form['material_2'] ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="material_3">Material 3</label>
                        <input type="number" class="form-control" id="material_3" name="material_3" value="<?= $form['material_3'] ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="material_4">Material 4</label>
                        <input type="number" class="form-control" id="material_4" name="material_4" value="<?= $form['material_4'] ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="material_5">Material 5</label>
                        <input type="number" class="form-control" id="material_5" name="material_5" value="<?= $form['material_5'] ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="material_6">Material 6</label>
                        <input type="number" class="form-control" id="material_6" name="material_6" value="<?= $form['material_6'] ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="material_7">Material 7</label>
                        <input type="number" class="form-control" id="material_7" name="material_7" value="<?= $form['material_7'] ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="material_8">Material 8</label>
                        <input type="number" class="form-control" id="material_8" name="material_8" value="<?= $form['material_8'] ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="material_9">Material 9</label>
                        <input type="number" class="form-control" id="material_9" name="material_9" value="<?= $form['material_9'] ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="material_10">Material 10</label>
                        <input type="number" class="form-control" id="material_10" name="material_10" value="<?= $form['material_10'] ?>">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="foto_material">Foto Material</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="foto_material" name="foto_material" accept="image/*" capture="camera">
                            <label class="custom-file-label" for="foto_material">Pilih file</label>
                        </div>
                        <?php if ($form['foto_material']): ?>
                            <small class="text-muted">File saat ini: <a href="<?= base_url('uploads/material/' . $form['foto_material']) ?>" target="_blank">Lihat</a></small>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="catatan">Catatan</label>
                <textarea class="form-control" id="catatan" name="catatan" rows="3"><?= $form['catatan'] ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="<?= site_url('pengawas-material/draft') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(function () {
        // BS-FileInput
        bsCustomFileInput.init();
    });
</script>
<?= $this->endSection() ?>