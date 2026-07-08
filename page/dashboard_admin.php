<?php
include "config/koneksi.php";

$jml_siswa = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM siswa"))['total'];
$jml_kelas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM kelas"))['total'];
?>

<style>
.card-modern {
    border-radius: 16px;
    transition: 0.3s;
    background: white;
}
.card-modern:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

.icon-circle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display:flex;
    align-items:center;
    justify-content:center;
}

.bg-blue { background: linear-gradient(135deg,#3b82f6,#6366f1); }
.bg-green { background: linear-gradient(135deg,#22c55e,#16a34a); }
.bg-orange { background: linear-gradient(135deg,#f59e0b,#f97316); }

/* BACKGROUND SECTION */
.section-gradient {
    background: linear-gradient(135deg,#6366f1,#3b82f6);
    color:white;
    border-radius:16px;
}
</style>

<div class="row">

    <div class="col-md-6 col-lg-4 mb-3">
        <div class="card card-modern shadow-sm border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">Total Siswa</small>
                    <h2><?= $jml_siswa ?></h2>
                </div>
                <div class="icon-circle bg-blue text-white">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4 mb-3">
        <div class="card card-modern shadow-sm border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">Total Kelas</small>
                    <h2><?= $jml_kelas ?></h2>
                </div>
                <div class="icon-circle bg-green text-white">
                    <i class="fas fa-school"></i>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- WELCOME -->
<div class="card section-gradient shadow-sm mt-3">
    <div class="card-body">
        <h4>👋 Selamat Datang, <?= $_SESSION['username'] ?></h4>
        <p>Semoga harimu menyenangkan 🚀</p>
    </div>
</div>

<!-- PROFILE -->
<div class="card card-modern shadow-sm mt-3 text-center">
    <div class="card-body">

        <div class="icon-circle bg-orange text-white mx-auto mb-3" style="width:70px;height:70px;">
            <b><?= strtoupper(substr($_SESSION['username'], 0, 1)); ?></b>
        </div>

        <h5><?= $_SESSION['username'] ?></h5>
        <small class="text-muted"><?= $_SESSION['role'] ?></small>

        <hr>

        <small>Login: <?= date("d M Y H:i") ?></small>
        <small>Copyright © 2026 Arief Budikurniawan. All rights reserved.</small>

    </div>
</div>