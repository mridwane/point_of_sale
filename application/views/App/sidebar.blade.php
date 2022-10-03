<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= site_url()?>dashboard" class="brand-link">
        <!-- <img src="<?= base_url(); ?>assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3"
            style="opacity: .8"> -->
        <span class="brand-text font-weight-light">POINT OF SALE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url();?>assets/images/Default.png" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?= site_url()?>Dashboard" class="nav-link <?php if(isset($title)) if($title == 'Dashboard') echo "active";?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item <?php if(isset($title)) if($title == 'Data Master') echo "menu-is-opening menu-open";?>">
                    <a href="#" class="nav-link <?php if(isset($title)) if($title == 'Data Master') echo "active";?>">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>
                            Data Master
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" <?php if(isset($title)) if($title == 'Data Master') echo 'style="display: block;"';?>>
                        <li class="nav-item">
                            <a href="<?= site_url()?>Product" class="nav-link <?php if(isset($sub_title)) if($sub_title == 'Data Barang') echo 'active';?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Barang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url()?>Procut_type" class="nav-link <?php if(isset($sub_title)) if($sub_title == 'Data Kategori') echo 'active';?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Kategori</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url()?>DataPenjualan" class="nav-link <?php if(isset($sub_title)) if($sub_title == 'Data Penjualan') echo 'active';?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Penjualan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url()?>Transaksi" class="nav-link <?php if(isset($title)) if($title == 'Transaksi Offline') echo "active";?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Trannsaksi Offline
                        </p>
                    </a>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>