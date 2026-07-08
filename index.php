<?php
ini_set('session.cookie_lifetime', 0);

if (session_status() == PHP_SESSION_NONE)
  session_start();

require_once "config/auth.php";
require_once "config/koneksi.php";
cek_login();

if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
  header("location:login.php");
  exit;
}

$page = isset($_GET['page']) ? $_GET['page'] : '';
$dataMaster = [
  'guru',
  'kelas',
  'siswa',
  'mapel',
  'jadwal_kelas',
  'detail_jadwal',
  'skripsi081'
];

// COUNT SEMUA DATA
$count_siswa = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM siswa"))['total'];
$count_guru = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM guru"))['total'];
$count_kelas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM kelas"))['total'];
$count_mapel = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM mapel"))['total'];
$count_jadwal = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM jadwal_kelas"))['total'];
$count_detail = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM detail_jadwal"))['total'];
$count_skripsi = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM skripsi081"))['total'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>KICAW Dashboard</title>

  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <style>
    body {
      background: linear-gradient(135deg, #eef2ff, #f8fafc);
    }

    /* SIDEBAR */
    .main-sidebar {
      background: linear-gradient(180deg, #0f172a, #1e293b);
    }

    /* BRAND */
    .brand-link {
      background: linear-gradient(90deg, #3b82f6, #6366f1);
      color: white !important;
      text-align: center;
      font-weight: bold;
    }

    /* NAV */
    .nav-sidebar .nav-link {
      margin: 6px 12px;
      border-radius: 10px;
      transition: 0.3s;
      color: #cbd5e1;
    }

    .nav-sidebar .nav-link:hover {
      background: rgba(255, 255, 255, 0.08);
      transform: translateX(6px);
      color: white;
    }

    .nav-sidebar .nav-link.active {
      background: linear-gradient(90deg, #3b82f6, #6366f1) !important;
      color: white !important;
    }

    /* BADGE */
    .badge-menu {
      float: right;
      background: #22c55e;
      font-size: 11px;
      padding: 3px 8px;
      border-radius: 20px;
    }

    /* CONTENT */
    .content-wrapper {
      padding: 15px;
    }

    /* CLOCK */
    .clock {
      font-weight: bold;
      color: #3b82f6;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- NAVBAR -->
    <nav class="main-header navbar navbar-expand navbar-white">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <span id="clock" class="clock"></span>
        </li>
      </ul>
    </nav>

    <!-- SIDEBAR -->
    <aside class="main-sidebar elevation-4">
      <a href="#" class="brand-link">🚀 KICAW</a>

      <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 text-center text-white">
          <strong><?= $_SESSION['username']; ?></strong><br>
          <small><?= $_SESSION['role']; ?></small>
        </div>

        <nav>
          <ul class="nav nav-sidebar flex-column" data-widget="treeview">

            <li class="nav-item">
              <a href="index.php" class="nav-link <?= ($page == '' ? 'active' : '') ?>">
                <i class="fas fa-home nav-icon"></i>
                <p>Home</p>
              </a>
            </li>

            <!-- DATA MASTER -->
            <li class="nav-item <?= in_array($page, $dataMaster) ? 'menu-open' : '' ?>">

              <a href="#" class="nav-link <?= in_array($page, $dataMaster) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-layer-group"></i>
                <p>Data Master <i class="right fas fa-angle-left"></i></p>
              </a>

              <ul class="nav nav-treeview">

                <li class="nav-item">
                  <a href="index.php?page=guru" class="nav-link <?= ($page == 'guru' ? 'active' : '') ?>">
                    <p>Guru <span class="badge-menu"><?= $count_guru ?></span></p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="index.php?page=kelas" class="nav-link <?= ($page == 'kelas' ? 'active' : '') ?>">
                    <p>Kelas <span class="badge-menu"><?= $count_kelas ?></span></p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="index.php?page=siswa" class="nav-link <?= ($page == 'siswa' ? 'active' : '') ?>">
                    <p>Siswa <span class="badge-menu"><?= $count_siswa ?></span></p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="index.php?page=mapel" class="nav-link <?= ($page == 'mapel' ? 'active' : '') ?>">
                    <p>Mapel <span class="badge-menu"><?= $count_mapel ?></span></p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="index.php?page=jadwal_kelas"
                    class="nav-link <?= ($page == 'jadwal_kelas' ? 'active' : '') ?>">
                    <p>Jadwal <span class="badge-menu"><?= $count_jadwal ?></span></p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="index.php?page=detail_jadwal"
                    class="nav-link <?= ($page == 'detail_jadwal' ? 'active' : '') ?>">
                    <p>Detail <span class="badge-menu"><?= $count_detail ?></span></p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="index.php?page=skripsi081" class="nav-link <?= ($page == 'skripsi081' ? 'active' : '') ?>">
                    <p>Skripsi <span class="badge-menu"><?= $count_skripsi ?></span></p>
                  </a>
                </li>

              </ul>
            </li>

            <li class="nav-item">
              <a href="index.php?page=ubahpassword" class="nav-link <?= ($page == 'ubahpassword' ? 'active' : '') ?>">
                <i class="fas fa-key nav-icon"></i>
                <p>Ubah Password</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="logout.php" class="nav-link text-danger">
                <i class="fas fa-sign-out-alt"></i>
                <p>Logout</p>
              </a>
            </li>

          </ul>
        </nav>
      </div>
    </aside>

    <!-- CONTENT -->
    <div class="content-wrapper">
      <?php

      if ($page == "") {

        include "page/dashboard_admin.php";

      } else {

        $file = "page/" . $page . ".php";

        if (file_exists($file)) {

          include $file;

        } else {

          include "page/dashboard_admin.php";

        }

      }

      ?>
    </div>
  
  </div>

  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="dist/js/adminlte.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    setInterval(() => {
      document.getElementById("clock").innerHTML = new Date().toLocaleTimeString();
    }, 1000);
  </script>

</body>

</html>