<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Semua Form Lapangan (Admin)</h3>
        <div class="card-tools">
            <a href="<?= site_url('pengawas-lapangan/create') ?>" class="btn btn-primary btn-sm">
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
                    <th>Proyek</th>
                    <th>Tanggal Pengawasan</th>
                    <th>Pengawas</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
    <?php foreach ($forms as $index => $form): 
        // Normalisasi data (handle both array dan object)
        $id = is_object($form) ? $form->id : $form['id'];
        $proyek = is_object($form) ? ($form->nama_proyek ?? 'N/A') : ($form['nama_proyek'] ?? 'N/A');
        $pengawas = is_object($form) ? ($form->nama_lengkap ?? 'Unknown') : ($form['nama_lengkap'] ?? 'Unknown');
        $tanggal = is_object($form) ? $form->tanggal_pengawasan : $form['tanggal_pengawasan'];
        $status = is_object($form) ? $form->status : $form['status'];
    ?>
    <tr>
        <td><?= $index + 1 ?></td>
        <td><?= htmlspecialchars($proyek, ENT_QUOTES, 'UTF-8') ?></td>
        <td>
            <?php try { 
                echo date('d/m/Y', strtotime($tanggal)); 
            } catch(Exception $e) { 
                echo 'Invalid Date'; 
            } ?>
        </td>
        <td><?= htmlspecialchars($pengawas, ENT_QUOTES, 'UTF-8') ?></td>
        <td>
            <span class="badge bg-<?= $status === 'terkirim' ? 'success' : 'warning' ?>">
                <?= ucfirst($status) ?>
            </span>
        </td>
        <td>
            <div class="btn-group">
                <a href="<?= site_url('pengawas-lapangan/view/' . $form['id']) ?>" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i>
                        </a>
                
                <?php if ($status === 'draft'): ?>
                <a href="/pengawas-lapangan/edit/<?= $id ?>" class="btn btn-sm btn-warning" title="Edit">
                    <i class="fas fa-edit"></i>
                </a>
                <a href="/pengawas-lapangan/kirim/<?= $id ?>" class="btn btn-sm btn-success" title="Kirim" onclick="return confirm('Kirim form ini?')">
                    <i class="fas fa-paper-plane"></i>
                </a>
                <?php endif; ?>
                
                <button onclick="confirmDelete('<?= site_url('pengawas-lapangan/delete/' . $id) ?>')" 
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