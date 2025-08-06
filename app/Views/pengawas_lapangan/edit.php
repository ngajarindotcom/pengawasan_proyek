<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Form Pengawasan Lapangan</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form action="<?= site_url('pengawas-lapangan/update/' . $form['id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="proyek_id">Nama Proyek</label>
                        <select class="form-control select2" id="proyek_id" name="proyek_id" required>
                            <option value="">Pilih Proyek</option>
                            <?php foreach ($proyek as $p): ?>
                            <option value="<?= $p['id'] ?>" <?= $form['proyek_id'] == $p['id'] ? 'selected' : '' ?>><?= $p['nama_proyek'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tanggal_pengawasan">Tanggal Pengawasan</label>
                        <input type="date" class="form-control" id="tanggal_pengawasan" name="tanggal_pengawasan" value="<?= $form['tanggal_pengawasan'] ?>" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="status_cuaca">Status Cuaca</label>
                <select class="form-control" id="status_cuaca" name="status_cuaca" required>
                    <option value="Cerah" <?= $form['status_cuaca'] == 'Cerah' ? 'selected' : '' ?>>Cerah</option>
                    <option value="Hujan" <?= $form['status_cuaca'] == 'Hujan' ? 'selected' : '' ?>>Hujan</option>
                    <option value="Mendung" <?= $form['status_cuaca'] == 'Mendung' ? 'selected' : '' ?>>Mendung</option>
                </select>
            </div>

            <div class="form-group">
                <label for="pekerjaan_dilakukan">Pekerjaan yang Dilakukan</label>
                <textarea class="form-control" id="pekerjaan_dilakukan" name="pekerjaan_dilakukan" rows="3" required><?= $form['pekerjaan_dilakukan'] ?></textarea>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="jumlah_pekerja">Jumlah Pekerja yang Hadir</label>
                        <input type="number" class="form-control" id="jumlah_pekerja" name="jumlah_pekerja" value="<?= $form['jumlah_pekerja'] ?>" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="kondisi_material">Kondisi Material</label>
                        <select class="form-control" id="kondisi_material" name="kondisi_material" required>
                            <option value="Cukup" <?= $form['kondisi_material'] == 'Cukup' ? 'selected' : '' ?>>Cukup</option>
                            <option value="Kurang" <?= $form['kondisi_material'] == 'Kurang' ? 'selected' : '' ?>>Kurang</option>
                            <option value="Rusak" <?= $form['kondisi_material'] == 'Rusak' ? 'selected' : '' ?>>Rusak</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="ketersediaan_alat">Ketersediaan Alat</label>
                        <select class="form-control" id="ketersediaan_alat" name="ketersediaan_alat" required>
                            <option value="Tersedia" <?= $form['ketersediaan_alat'] == 'Tersedia' ? 'selected' : '' ?>>Tersedia</option>
                            <option value="Tidak Tersedia" <?= $form['ketersediaan_alat'] == 'Tidak Tersedia' ? 'selected' : '' ?>>Tidak Tersedia</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="penerapan_sop_k3">Penerapan SOP K3</label>
                <select class="form-control" id="penerapan_sop_k3" name="penerapan_sop_k3" required>
                    <option value="Diterapkan" <?= $form['penerapan_sop_k3'] == 'Diterapkan' ? 'selected' : '' ?>>Diterapkan</option>
                    <option value="Tidak Diterapkan" <?= $form['penerapan_sop_k3'] == 'Tidak Diterapkan' ? 'selected' : '' ?>>Tidak Diterapkan</option>
                </select>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="foto_toolbox">Foto Toolbox Meeting</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="foto_toolbox" name="foto_toolbox" accept="image/*" capture="camera">
                            <label class="custom-file-label" for="foto_toolbox">Pilih file</label>
                        </div>
                        <?php if ($form['foto_toolbox']): ?>
                            <small class="text-muted">File saat ini: <a href="<?= base_url('uploads/lapangan/' . $form['foto_toolbox']) ?>" target="_blank">Lihat</a></small>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="foto_checkup">Foto Checkup Pekerja</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="foto_checkup" name="foto_checkup" accept="image/*" capture="camera">
                            <label class="custom-file-label" for="foto_checkup">Pilih file</label>
                        </div>
                        <?php if ($form['foto_checkup']): ?>
                            <small class="text-muted">File saat ini: <a href="<?= base_url('uploads/lapangan/' . $form['foto_checkup']) ?>" target="_blank">Lihat</a></small>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="foto_pelaksanaan">Foto Pelaksanaan Pekerjaan</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="foto_pelaksanaan" name="foto_pelaksanaan" accept="image/*" capture="camera">
                            <label class="custom-file-label" for="foto_pelaksanaan">Pilih file</label>
                        </div>
                        <?php if ($form['foto_pelaksanaan']): ?>
                            <small class="text-muted">File saat ini: <a href="<?= base_url('uploads/lapangan/' . $form['foto_pelaksanaan']) ?>" target="_blank">Lihat</a></small>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="foto_alat_bahan">Foto Alat dan Bahan</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="foto_alat_bahan" name="foto_alat_bahan" accept="image/*" capture="camera">
                            <label class="custom-file-label" for="foto_alat_bahan">Pilih file</label>
                        </div>
                        <?php if ($form['foto_alat_bahan']): ?>
                            <small class="text-muted">File saat ini: <a href="<?= base_url('uploads/lapangan/' . $form['foto_alat_bahan']) ?>" target="_blank">Lihat</a></small>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="catatan">Catatan</label>
                <textarea class="form-control" id="catatan" name="catatan" rows="3"><?= $form['catatan'] ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="<?= site_url('pengawas-lapangan/draft') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(function () {
        // Initialize Select2 Elements
        $('.select2').select2()

        // BS-FileInput
        bsCustomFileInput.init();

        // Date picker
        $('#tanggal_pengawasan').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
    });
</script>
<?= $this->endSection() ?>