<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Draft Form Lapangan</h3>
        <div class="card-tools">
            <a href="<?= site_url('pengawas-lapangan/create') ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Form
            </a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="draftTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Proyek</th>
                    <th>Tanggal Pengawasan</th>
                    <th>Pengawas</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($forms as $index => $form): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= $form['nama_proyek'] ?></td>
                    <td><?= date('d/m/Y', strtotime($form['tanggal_pengawasan'])) ?></td>
                    <td><?= $form['nama_lengkap'] ?></td>
                    <td><span class="badge bg-warning"><?= ucfirst($form['status']) ?></span></td>
                    <td>
                        <a href="<?= site_url('pengawas-lapangan/view/' . $form['id']) ?>" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="<?= site_url('pengawas-lapangan/edit/' . $form['id']) ?>" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="<?= site_url('pengawas-lapangan/kirim/' . $form['id']) ?>" class="btn btn-sm btn-success" onclick="return confirm('Kirim form ini?')">
                            <i class="fas fa-paper-plane"></i>
                        </a>
                        <button onclick="confirmDelete('<?= site_url('pengawas-lapangan/delete/' . $form['id']) ?>')" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(function () {
        $("#draftTable").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#draftTable_wrapper .col-md-6:eq(0)');
    });

    function confirmDelete(url) {
        if (confirm('Apakah Anda yakin ingin menghapus form ini?')) {
            window.location.href = url;
        }
    }
</script>
<?= $this->endSection() ?>