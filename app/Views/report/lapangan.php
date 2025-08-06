<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Filter Laporan</h3>
    </div>
    <div class="card-body">
        <form action="<?= site_url('report/lapangan') ?>" method="get">
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
            <a href="<?= site_url('report/lapangan') ?>" class="btn btn-secondary">Reset</a>
            <a href="<?= site_url('report/exportLapanganPdf?' . http_build_query($filter)) ?>" class="btn btn-danger" target="_blank">
                <i class="fas fa-file-pdf"></i> Export PDF
            </a>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Statistik Cuaca</h3>
            </div>
            <div class="card-body">
                <canvas id="cuacaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Statistik Penerapan SOP K3</h3>
            </div>
            <div class="card-body">
                <canvas id="k3Chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Statistik Kondisi Material</h3>
            </div>
            <div class="card-body">
                <canvas id="materialChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Statistik Ketersediaan Alat</h3>
            </div>
            <div class="card-body">
                <canvas id="alatChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Form Lapangan</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="lapanganTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Proyek</th>
                    <th>Tanggal</th>
                    <th>Pengawas</th>
                    <th>Cuaca</th>
                    <th>Pekerja</th>
                    <th>Material</th>
                    <th>Alat</th>
                    <th>K3</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($forms as $index => $form): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= $form['nama_proyek'] ?></td>
                    <td><?= date('d/m/Y', strtotime($form['tanggal_pengawasan'])) ?></td>
                    <td><?= $form['nama_lengkap'] ?></td>
                    <td><?= $form['status_cuaca'] ?></td>
                    <td><?= $form['jumlah_pekerja'] ?></td>
                    <td><?= $form['kondisi_material'] ?></td>
                    <td><?= $form['ketersediaan_alat'] ?></td>
                    <td><?= $form['penerapan_sop_k3'] ?></td>
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
        $("#lapanganTable").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#lapanganTable_wrapper .col-md-6:eq(0)');

        // Cuaca Chart
        var cuacaCtx = document.getElementById('cuacaChart').getContext('2d');
        var cuacaChart = new Chart(cuacaCtx, {
            type: 'doughnut',
            data: {
                labels: ['Cerah', 'Hujan', 'Mendung'],
                datasets: [{
                    data: [<?= $chartData['cuaca']['Cerah'] ?>, <?= $chartData['cuaca']['Hujan'] ?>, <?= $chartData['cuaca']['Mendung'] ?>],
                    backgroundColor: ['#00a65a', '#dd4b39', '#f39c12'],
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
            }
        });

        // K3 Chart
        var k3Ctx = document.getElementById('k3Chart').getContext('2d');
        var k3Chart = new Chart(k3Ctx, {
            type: 'pie',
            data: {
                labels: ['Diterapkan', 'Tidak Diterapkan'],
                datasets: [{
                    data: [<?= $chartData['k3']['Diterapkan'] ?>, <?= $chartData['k3']['Tidak Diterapkan'] ?>],
                    backgroundColor: ['#00a65a', '#dd4b39'],
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
            }
        });

        // Material Chart
        var materialCtx = document.getElementById('materialChart').getContext('2d');
        var materialChart = new Chart(materialCtx, {
            type: 'bar',
            data: {
                labels: ['Cukup', 'Kurang', 'Rusak'],
                datasets: [{
                    label: 'Kondisi Material',
                    data: [<?= $chartData['material']['Cukup'] ?>, <?= $chartData['material']['Kurang'] ?>, <?= $chartData['material']['Rusak'] ?>],
                    backgroundColor: ['#00a65a', '#f39c12', '#dd4b39'],
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

        // Alat Chart
        var alatCtx = document.getElementById('alatChart').getContext('2d');
        var alatChart = new Chart(alatCtx, {
            type: 'polarArea',
            data: {
                labels: ['Tersedia', 'Tidak Tersedia'],
                datasets: [{
                    data: [<?= $chartData['alat']['Tersedia'] ?>, <?= $chartData['alat']['Tidak Tersedia'] ?>],
                    backgroundColor: ['#00a65a', '#dd4b39'],
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
            }
        });
    });
</script>
<?= $this->endSection() ?>