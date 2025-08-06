<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Form Pengawasan Lapangan</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form action="<?= site_url('pengawas-lapangan/store') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="proyek_id">Nama Proyek</label>
                        <select class="form-control" id="proyek_id" name="proyek_id" required>
                            <option value="">Pilih Proyek</option>
                            <?php foreach ($proyek as $p): ?>
                            <option value="<?= $p['id'] ?>"><?= $p['nama_proyek'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tanggal_pengawasan">Tanggal Pengawasan</label>
                        <input type="date" class="form-control" id="tanggal_pengawasan" name="tanggal_pengawasan" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="status_cuaca">Status Cuaca</label>
                <select class="form-control" id="status_cuaca" name="status_cuaca" required>
                    <option value="">Pilih Status Cuaca</option>
                    <option value="Cerah">Cerah</option>
                    <option value="Hujan">Hujan</option>
                    <option value="Mendung">Mendung</option>
                </select>
            </div>

            <div class="form-group">
                <label for="pekerjaan_dilakukan">Pekerjaan yang Dilakukan</label>
                <textarea class="form-control" id="pekerjaan_dilakukan" name="pekerjaan_dilakukan" rows="3" required></textarea>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="jumlah_pekerja">Jumlah Pekerja yang Hadir</label>
                        <input type="number" class="form-control" id="jumlah_pekerja" name="jumlah_pekerja" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="kondisi_material">Kondisi Material</label>
                        <select class="form-control" id="kondisi_material" name="kondisi_material" required>
                            <option value="">Pilih Kondisi</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Kurang">Kurang</option>
                            <option value="Rusak">Rusak</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="ketersediaan_alat">Ketersediaan Alat</label>
                        <select class="form-control" id="ketersediaan_alat" name="ketersediaan_alat" required>
                            <option value="">Pilih Ketersediaan</option>
                            <option value="Tersedia">Tersedia</option>
                            <option value="Tidak Tersedia">Tidak Tersedia</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="penerapan_sop_k3">Penerapan SOP K3</label>
                <select class="form-control" id="penerapan_sop_k3" name="penerapan_sop_k3" required>
                    <option value="">Pilih Status</option>
                    <option value="Diterapkan">Diterapkan</option>
                    <option value="Tidak Diterapkan">Tidak Diterapkan</option>
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
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="foto_checkup">Foto Checkup Pekerja</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="foto_checkup" name="foto_checkup" accept="image/*" capture="camera">
                            <label class="custom-file-label" for="foto_checkup">Pilih file</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="foto_pelaksanaan">Foto Pelaksanaan Pekerjaan</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="foto_pelaksanaan" name="foto_pelaksanaan" accept="image/*" capture="camera">
                            <label class="custom-file-label" for="foto_pelaksanaan">Pilih file</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="foto_alat_bahan">Foto Alat dan Bahan</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="foto_alat_bahan" name="foto_alat_bahan" accept="image/*" capture="camera">
                            <label class="custom-file-label" for="foto_alat_bahan">Pilih file</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="catatan">Catatan</label>
                <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Draft</button>
            <a href="<?= site_url('pengawas-lapangan') ?>" class="btn btn-secondary">Batal</a>
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