<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data User</h3>
        <div class="card-tools">
            <a href="<?= site_url('users/create') ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah User
            </a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="usersTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Nama Lengkap</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $index => $user): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= $user['username'] ?></td>
                    <td><?= $user['nama_lengkap'] ?></td>
                    <td><?= ucfirst(str_replace('_', ' ', $user['role'])) ?></td>
                    <td>
                        <a href="<?= site_url('users/edit/' . $user['id']) ?>" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button onclick="confirmDelete('<?= site_url('users/delete/' . $user['id']) ?>')" class="btn btn-sm btn-danger">
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
        $("#usersTable").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#usersTable_wrapper .col-md-6:eq(0)');
    });

    function confirmDelete(url) {
        if (confirm('Apakah Anda yakin ingin menghapus user ini?')) {
            window.location.href = url;
        }
    }
</script>
<?= $this->endSection() ?>