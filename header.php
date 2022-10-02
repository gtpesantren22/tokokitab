<?php
session_start();
if (!isset($_SESSION['qwertyuioplkjhgfdsa'])) {

    echo "
    <script>
    window.location = 'login.php';
    </script>
    ";
}

// include 'koneksi.php';

$nama_user = $_SESSION['nama'];

$bulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "July", "Agustus", "September", "Oktober", "November", "Desember");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Toko Kitab - PPDWK</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="./assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="./assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <link href="./assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <link href="./assets/vendors/DataTables/datatables.min.css" rel="stylesheet" />
    <link href="./assets/vendors/select2/dist/css/select2.min.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="assets/css/main.min.css" rel="stylesheet" />

</head>

<body class="fixed-navbar">
    <div class="page-wrapper">
        <!-- START HEADER-->
        <header class="header">
            <div class="page-brand">
                <a class="link" href="index.html">
                    <span class="brand">Toko
                        <span class="brand-tip">Kitab</span>
                    </span>
                    <span class="brand-mini">TK</span>
                </a>
            </div>
            <div class="flexbox flex-1">
                <!-- START TOP-LEFT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                    <li>
                        <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
                    </li>
                    <li>
                        <form class="navbar-search" action="javascript:;">
                            <div class="rel">
                                <span class="search-icon"><i class="ti-search"></i></span>
                                <input class="form-control" placeholder="Search here...">
                            </div>
                        </form>
                    </li>
                </ul>
                <!-- END TOP-LEFT TOOLBAR-->
                <!-- START TOP-RIGHT TOOLBAR-->
                <ul class="nav navbar-toolbar">

                    <li class="dropdown dropdown-user">
                        <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                            <img src="./assets/img/admin-avatar.png" />
                            <span></span>Admin<i class="fa fa-angle-down m-l-5"></i></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <!-- <a class="dropdown-item" href="profile.html"><i class="fa fa-user"></i>Profile</a> -->
                            <a class="dropdown-item" href="profile.html"><i class="fa fa-cog"></i>Settings</a>
                            <!-- <a class="dropdown-item" href="javascript:;"><i class="fa fa-support"></i>Support</a> -->
                            <li class="dropdown-divider"></li>
                            <a class="dropdown-item" href="logout.php"><i class="fa fa-power-off"></i>Logout</a>
                        </ul>
                    </li>
                </ul>
                <!-- END TOP-RIGHT TOOLBAR-->
            </div>
        </header>
        <!-- END HEADER-->
        <!-- START SIDEBAR-->
        <nav class="page-sidebar" id="sidebar">
            <div id="sidebar-collapse">
                <div class="admin-block d-flex">
                    <div>
                        <img src="./assets/img/admin-avatar.png" width="45px" />
                    </div>
                    <div class="admin-info">
                        <div class="font-strong">SMKDWK</div><small>Project</small>
                    </div>
                </div>
                <ul class="side-menu metismenu">
                    <li>
                        <a class="active" href="media.php"><i class="sidebar-item-icon fa fa-th-large"></i>
                            <span class="nav-label">Dashboard</span>
                        </a>
                    </li>

                    <li class="heading">PAGES</li>
                    <li>
                        <a href="admin.php"><i class="sidebar-item-icon fa fa-user"></i>
                            <span class="nav-label">Data Admin</span>
                        </a>
                    </li>
                    <li>
                        <a href="santri.php"><i class="sidebar-item-icon fa fa-users"></i>
                            <span class="nav-label">Data Santri</span>
                        </a>
                    </li>

                    <li>
                        <a href="kitab.php"><i class="sidebar-item-icon fa fa-book"></i>
                            <span class="nav-label">Data Kitab</span>
                        </a>
                    </li>

                    <li>
                        <a href="kolakan.php"><i class="sidebar-item-icon ti-shopping-cart"></i>
                            <span class="nav-label">Kolakan</span>
                        </a>
                    </li>

                    <li>
                        <a href="penjualan.php"><i class="sidebar-item-icon fa fa-money"></i>
                            <span class="nav-label">Penjualan</span>
                        </a>
                    </li>



                </ul>
            </div>
        </nav>
        <!-- END SIDEBAR-->
        <div class="content-wrapper">