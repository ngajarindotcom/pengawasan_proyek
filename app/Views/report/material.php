<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Filter Laporan</h3>
    </div>
    <div class="card-body">
        <form action="<?= site_url('report/material') ?>" method="get">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Tanggal Mulai</label>
                        <input type="date" class="form-control" name="start_date" value="<?= $filter['start_date'] ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Tanggal Selesai</label>
                        <input type="date" class="form-control" name="end_date" value="<?= $filter['end_date'] ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Pengawas</label>
                        <select class="form-control select2" name="user_id">
                            <option value="">Semua Pengawas</option>
                            <?php foreach ($users as $user): ?>
                            <option value="<?= $user['id'] ?>" <?= $filter['user_id'] == $user['id'] ? 'selected' : '' ?>><?= $user['nama_lengkap'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="<?= site_url('report/material') ?>" class="btn btn-secondary">Reset</a>
            <a href="<?= site_url('report/exportMaterialPdf?' . http_build_query($filter)) ?>" class="btn btn-danger" target="_blank">
                <i class="fas fa-file-pdf"></i> Export PDF
            </a>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Statistik Material</h3>
    </div>
    <div class="card-body">
        <canvas id="materialChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Form Material</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="materialTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Pengawas</th>
                    <th>Material 1</th>
                    <th>Material 2</th>
                    <th>Material 3</th>
                    <th>Material 4</th>
                    <th>Material 5</th>
                    <th>Material 6</th>
                    <th>Material 7</th>
                    <th>Material 8</th>
                    <th>Material 9</th>
                    <th>Material 10</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($forms as $index => $form): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= date('d/m/Y', strtotime($form['created_at'])) ?></td>
                    <td><?= $form['nama_lengkap'] ?></td>
                    <td><?= $form['material_1'] ?? '-' ?></td>
                    <td><?= $form['material_2'] ?? '-' ?></td>
                    <td><?= $form['material_3'] ?? '-' ?></td>
                    <td><?= $form['material_4'] ?? '-' ?></td>
                    <td><?= $form['material_5'] ?? '-' ?></td>
                    <td><?= $form['material_6'] ?? '-' ?></td>
                    <td><?= $form['material_7'] ?? '-' ?></td>
                    <td><?= $form['material_8'] ?? '-' ?></td>
                    <td><?= $form['material_9'] ?? '-' ?></td>
                    <td><?= $form['material_10'] ?? '-' ?></td>
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
        $("#materialTable").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#materialTable_wrapper .col-md-6:eq(0)');

        // Material Chart
        var materialCtx = document.getElementById('materialChart').getContext('2d');
        var materialChart = new Chart(materialCtx, {
            type: 'bar',
            data: {
                labels: ['Material 1', 'Material 2', 'Material 3', 'Material 4', 'Material 5', 'Material 6', 'Material 7', 'Material 8', 'Material 9', 'Material 10'],
                datasets: [{
                    label: 'Rata-rata Kuantitas',
                    data: [
                        <?= $chartData['material_1'] ?? 0 ?>,
                        <?= $chartData['material_2'] ?? 0 ?>,
                        <?= $chartData['material_3'] ?? 0 ?>,
                        <?= $chartData['material_4'] ?? 0 ?>,
                        <?= $chartData['material_5'] ?? 0 ?>,
                        <?= $chartData['material_6'] ?? 0 ?>,
                        <?= $chartData['material_7'] ?? 0 ?>,
                        <?= $chartData['material_8'] ?? 0 ?>,
                        <?= $chartData['material_9'] ?? 0 ?>,
                        <?= $chartData['material_10'] ?? 0 ?>
                    ],
                    backgroundColor: [
                        '#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc',
                        '#d2d6de', '#ff851b', '#001f3f', '#39CCCC', '#605ca8'
                    ],
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
<?= $this->endSection() ?>