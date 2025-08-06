<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? 'Aplikasi Pengawasan Proyek' ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/jqvmap/jqvmap.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/dist/css/adminlte.min.css') ?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/daterangepicker/daterangepicker.css') ?>">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/summernote/summernote-bs4.min.css') ?>">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/select2/css/select2.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/toastr/toastr.min.css') ?>">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="<?= base_url('assets/adminlte/dist/img/AdminLTELogo.png') ?>" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?= site_url('dashboard') ?>" class="nav-link">Dashboard</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-user"></i> <?= session()->get('nama_lengkap') ?>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="<?= site_url('profile') ?>" class="dropdown-item">
                        <i class="fas fa-user mr-2"></i> Profil
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="<?= site_url('logout') ?>" class="dropdown-item">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="<?= site_url('dashboard') ?>" class="brand-link">
            <img src="<?= base_url('assets/adminlte/dist/img/AdminLTELogo.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Pengawasan Proyek</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="<?= site_url('dashboard') ?>" class="nav-link <?= (uri_string() == 'dashboard') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <?php if (session()->get('role') === 'admin'): ?>
                    <li class="nav-item">
                        <a href="<?= site_url('users') ?>" class="nav-link <?= (uri_string() == 'users') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Manajemen User</p>
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php if (in_array(session()->get('role'), ['admin', 'pengawas_lapangan'])): ?>
                    <li class="nav-item <?= strpos(uri_string(), 'pengawas-lapangan') !== false ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= strpos(uri_string(), 'pengawas-lapangan') !== false ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-hard-hat"></i>
                            <p>
                                Pengawas Lapangan
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if (session('role') === 'pengawas'): ?>
                            <li class="nav-item">
                                <a href="<?= site_url('pengawas-lapangan/draft') ?>" class="nav-link <?= (uri_string() == 'pengawas-lapangan/draft') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Draft Form</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('pengawas-lapangan/terkirim') ?>" class="nav-link <?= (uri_string() == 'pengawas-lapangan/terkirim') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Form Terkirim</p>
                                </a>
                            </li>
                            <?php endif; ?>
                            <li class="nav-item">
                                <a href="<?= site_url('pengawas-lapangan/create') ?>" class="nav-link <?= (uri_string() == 'pengawas-lapangan/create') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Buat Form Baru</p>
                                </a>
                            </li>
                            <?php if (session('role') === 'admin'): ?>
                            <li class="nav-item">
                                <a href="<?= site_url('pengawas-lapangan/all') ?>" class="nav-link">
                                    <i class="fas fa-list nav-icon"></i> Form Lapangan
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <?php if (in_array(session()->get('role'), ['admin', 'pengawas_material'])): ?>
                    <li class="nav-item <?= strpos(uri_string(), 'pengawas-material') !== false ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= strpos(uri_string(), 'pengawas-material') !== false ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-boxes"></i>
                            <p>
                                Pengawas Material
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if (session('role') === 'pengawas_material'): ?>
                            <li class="nav-item">
                                <a href="<?= site_url('pengawas-material/draft') ?>" class="nav-link <?= (uri_string() == 'pengawas-material/draft') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Draft Form</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('pengawas-material/terkirim') ?>" class="nav-link <?= (uri_string() == 'pengawas-material/terkirim') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Form Terkirim</p>
                                </a>
                            </li>
                             <?php endif; ?>
                            <li class="nav-item">
                                <a href="<?= site_url('pengawas-material/create') ?>" class="nav-link <?= (uri_string() == 'pengawas-material/create') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Buat Form Baru</p>
                                </a>
                            </li>
                            <?php if (session('role') === 'admin'): ?>
                            <li class="nav-item">
                                <a href="<?= site_url('pengawas-material/all') ?>" class="nav-link">
                                    <i class="fas fa-list nav-icon"></i> Form Material
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <?php if (session()->get('role') === 'admin'): ?>
                    <li class="nav-item <?= strpos(uri_string(), 'report') !== false ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= strpos(uri_string(), 'report') !== false ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-chart-bar"></i>
                            <p>
                                Laporan
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url('report/lapangan') ?>" class="nav-link <?= (uri_string() == 'report/lapangan') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Laporan Lapangan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('report/material') ?>" class="nav-link <?= (uri_string() == 'report/material') ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Laporan Material</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <a href="<?= site_url('profile') ?>" class="nav-link <?= (uri_string() == 'profile') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Profil</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?= site_url('logout') ?>" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><?= $title ?? 'Dashboard' ?></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Home</a></li>
                            <li class="breadcrumb-item active"><?= $title ?? 'Dashboard' ?></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <?= $this->renderSection('content') ?>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <strong>Copyright &copy; <?= date('Y') ?> Aplikasi Pengawasan Proyek.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0.0
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url('assets/adminlte/plugins/jquery/jquery.min.js') ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/adminlte/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- ChartJS -->
<script src="<?= base_url('assets/adminlte/plugins/chart.js/Chart.min.js') ?>"></script>
<!-- Sparkline -->
<script src="<?= base_url('assets/adminlte/plugins/sparklines/sparkline.js') ?>"></script>
<!-- JQVMap -->
<script src="<?= base_url('assets/adminlte/plugins/jqvmap/jquery.vmap.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/jqvmap/maps/jquery.vmap.world.js') ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url('assets/adminlte/plugins/jquery-knob/jquery.knob.min.js') ?>"></script>
<!-- daterangepicker -->
<script src="<?= base_url('assets/adminlte/plugins/moment/moment.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/daterangepicker/daterangepicker.js') ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('assets/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ?>"></script>
<!-- Summernote -->
<script src="<?= base_url('assets/adminlte/plugins/summernote/summernote-bs4.min.js') ?>"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/adminlte/dist/js/adminlte.js') ?>"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('assets/adminlte/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/jszip/jszip.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/pdfmake/pdfmake.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/pdfmake/vfs_fonts.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/buttons.print.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') ?>"></script>
<!-- Select2 -->
<script src="<?= base_url('assets/adminlte/plugins/select2/js/select2.full.min.js') ?>"></script>
<!-- Toastr -->
<script src="<?= base_url('assets/adminlte/plugins/toastr/toastr.min.js') ?>"></script>

<!-- Custom JS -->
<script src="<?= base_url('assets/js/custom.js') ?>"></script>

<script>
    // Initialize Select2 Elements
    $('.select2').select2()

    // Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })

    // Toastr notifications
    <?php if (session()->getFlashdata('success')): ?>
        toastr.success('<?= session()->getFlashdata('success') ?>')
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        toastr.error('<?= session()->getFlashdata('error') ?>')
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')): ?>
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            toastr.error('<?= $error ?>')
        <?php endforeach; ?>
    <?php endif; ?>
</script>

<?= $this->renderSection('scripts') ?>
</body>
</html>