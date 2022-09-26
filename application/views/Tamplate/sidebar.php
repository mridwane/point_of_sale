<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                <?php 
                    $akses = $this->session->userdata('kd_role');
                    if($akses == 1)
                    {?>
                    <li class="nav-small-cap"><span class="hide-menu">Menu</span></li>
                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link active" href="<?= site_url()?>Dashboard" aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span class="hide-menu">Dashboard</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span class="hide-menu">Data Master</span></a>
                        <ul aria-expanded="false" class="collapse  first-level base-level-line">
                            <li class="sidebar-item"><a href="<?= site_url()?>Barang" class="sidebar-link"><span
                                        class="hide-menu"> Data Barang
                                    </span></a>
                            </li>
                            <li class="sidebar-item"><a href="<?= site_url()?>Kategori" class="sidebar-link"><span
                                        class="hide-menu"> Data Kategori
                                    </span></a>
                            </li>                            
                            <li class="sidebar-item"><a href="<?= site_url()?>DataPenjualan" class="sidebar-link"><span
                                        class="hide-menu"> Data Penjualan   
                                    </span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="<?= site_url()?>Transaksi" aria-expanded="false"><i data-feather="dollar-sign" class="feather-icon"></i><span class="hide-menu">Transaksi</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false"><i data-feather="book-open" class="feather-icon"></i><span class="hide-menu">Laporan</span></a>
                        <ul aria-expanded="false" class="collapse  first-level base-level-line">
                            <li class="sidebar-item"><a href="<?= site_url()?>Laporan/barang" class="sidebar-link"><span
                                        class="hide-menu"> Laporan Barang
                                    </span></a>
                            </li>
                            <li class="sidebar-item"><a href="<?= site_url()?>Laporan/barang_masuk" class="sidebar-link"><span
                                        class="hide-menu"> Laporan Barang Masuk
                                    </span></a>
                            </li>
                            <li class="sidebar-item"><a href="<?= site_url()?>Laporan/perbulan" class="sidebar-link"><span
                                        class="hide-menu"> Laporan Data Perbulan
                                    </span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="list-divider"></li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false"><i data-feather="user" class="feather-icon"></i><span class="hide-menu">Pengaturan User</span></a>
                        <ul aria-expanded="false" class="collapse  first-level base-level-line">
                            <li class="sidebar-item"><a href="<?= site_url()?>Pengaturan_user/permintaan_reg" class="sidebar-link"><span
                                        class="hide-menu"> Permintaan Registrasi
                                    </span></a>
                            </li>
                            <li class="sidebar-item"><a href="<?= site_url()?>Pengaturan_user/manajemen_user" class="sidebar-link"><span
                                        class="hide-menu"> Manajemen Pengguna
                                    </span></a>
                            </li>
                            <li class="sidebar-item"><a href="<?= site_url()?>Pengaturan_user/ganti_password" class="sidebar-link"><span
                                        class="hide-menu"> Ganti Kata Sandi
                                    </span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="<?= site_url()?>Auth/logout"
                            aria-expanded="false"><i data-feather="log-out" class="feather-icon"></i><span
                                class="hide-menu">Logout</span></a></li>
                                
                    <?php } else {?>
                    
                    <li class="nav-small-cap"><span class="hide-menu">Menu</span></li>
                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link active" href="<?= site_url()?>Dashboard" aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span class="hide-menu">Dashboard</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="<?= site_url()?>Transaksi" aria-expanded="false"><i data-feather="dollar-sign" class="feather-icon"></i><span class="hide-menu">Transaksi</span></a></li>
                    
                    <li class="list-divider"></li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false"><i data-feather="user" class="feather-icon"></i><span class="hide-menu">Pengaturan User</span></a>
                        <ul aria-expanded="false" class="collapse  first-level base-level-line">
                            <li class="sidebar-item"><a href="<?= site_url()?>Pengaturan_user/ganti_password" class="sidebar-link"><span
                                        class="hide-menu"> Ganti Kata Sandi
                                    </span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="<?= site_url()?>Auth/logout"
                            aria-expanded="false"><i data-feather="log-out" class="feather-icon"></i><span
                                class="hide-menu">Logout</span></a></li>
                    <?php }?>
                    
                </ul>
            </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
    <?php
    //ubah timezone menjadi jakarta
    date_default_timezone_set("Asia/Jakarta");

    //ambil jam dan menit
    $jam = date('H:i');

    //atur salam menggunakan IF
    if ($jam > '05:30' && $jam < '10:00') {
        $salam = 'Pagi';
    } elseif ($jam >= '10:00' && $jam < '15:00') {
        $salam = 'Siang';
    } elseif ($jam < '18:00') {
        $salam = 'Sore';
    } else {
        $salam = 'Malam';
    }

    //tampilkan pesan
    
    $nama = $this->session->userdata('nama');
    $namaDepan = explode(" ",$nama);

    ?>
    
<div class="page-wrapper">
        <?= $this->session->flashdata('stokhabis'); ?>
        <?= $this->session->flashdata('stok'); ?>
        
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1"><?='Selamat ' . $salam .', '. $namaDepan[0]; ?></h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html"><?php echo $title; ?></a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-5 align-self-center">
                        <div class="customize-input float-right">
                            <p class="form-control bg-white border-0 custom-shadow custom-radius">
                                <?= date("D, d/m/y");   ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>