<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= site_url('Admin'); ?>">
                <div class=" sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="sidebar-brand-text mx-3">AKCAT</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('Admin'); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <!-- <div class="sidebar-heading">
                Bank Soal
            </div> -->

            <!-- Nav Item - Kategori -->
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('Admin/Kategori'); ?>">
                    <i class="fas fa-fw fa-layer-group"></i>
                    <span>Kategori Soal</span></a>
            </li>

            <hr class="sidebar-divider">

            <!-- Nav Item - Pertanyaan -->
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('Admin/Pertanyaan'); ?>">
                    <i class="fas fa-fw fa-question-circle"></i>
                    <span>Pertanyaan</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <!-- <div class="sidebar-heading">
                Sesi Ujian
            </div> -->

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('Admin/SesiUjian'); ?>">
                    <i class="fas fa-fw fa-calendar-alt"></i>
                    <span>Sesi Ujian</span></a>
            </li>
            <!-- Nav Item - Pages Collapse Menu -->



            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('Admin/Peserta'); ?>">
                    <i class="fas fa-fw fa-user-circle"></i>
                    <span>Peserta</span></a>
            </li>
            <!-- <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('Admin/NilaiUjian'); ?>">
                    <i class="fas fa-fw fa-chart-bar"></i>
                    <span>Nilai Ujian</span></a>
            </li> -->
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->