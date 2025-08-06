<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Semua Form Material (Admin)</h3>
        <div class="card-tools">
            <a href="<?= site_url('pengawas-material/create') ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Form
            </a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="allTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Proyek</th>
                    <th>Pengawas</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($forms as $index => $form): ?>
                <?php 
                    $id = is_object($form) ? $form->id : $form['id'];
                    $currentStatus = is_object($form) ? $form->status : $form['status'];
                ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= date('d/m/Y', strtotime(is_object($form) ? $form->created_at : $form['created_at'])) ?></td>
                    <td><?= is_object($form) ? $form->nama_proyek : $form['nama_proyek'] ?></td>
                    <td><?= is_object($form) ? $form->nama_lengkap : $form['nama_lengkap'] ?></td>
                    <td>
                        <span class="badge bg-<?= ($currentStatus === 'terkirim' ? 'success' : 'warning') ?>">
                            <?= ucfirst($currentStatus) ?>
                        </span>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="<?= site_url('pengawas-material/view/' . $id) ?>" class="btn btn-sm btn-info" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            
                            <?php if ($currentStatus === 'draft'): ?>
                            <a href="<?= site_url('pengawas-material/edit/' . $id) ?>" class="btn btn-sm btn-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="<?= site_url('pengawas-material/kirim/' . $id) ?>" class="btn btn-sm btn-success" title="Kirim" onclick="return confirm('Kirim form ini?')">
                                <i class="fas fa-paper-plane"></i>
                            </a>
                            <?php endif; ?>
                            
                            <button onclick="confirmDelete('<?= site_url('pengawas-material/delete/' . $id) ?>')" 
                                    class="btn btn-sm btn-danger" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
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
        $("#allTable").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#allTable_wrapper .col-md-6:eq(0)');
    });

    function confirmDelete(url) {
        if (confirm('Apakah Anda yakin ingin menghapus form ini?')) {
            window.location.href = url;
        }
    }
</script>
<?= $this->endSection() ?>