<?php

require_once "config/auth.php";
hanya_admin();
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Skripsi</h1>
            </div>
        </div>
    </div>
</div>

<?php
include "config/koneksi.php";
$kd = $_GET['kd'];
$edit = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM skripsi081 WHERE skripsi081='$kd'"));

if (isset($_POST['tambah'])) {
    $Id_skripsi = $_POST['id_skripsi'];
    $Judul_skripsi = $_POST['judul_skripsi'];
    $Topik = $_POST['topik081'];
    $Semester = $_POST['semester'];
    $Thn_ajaran = $_POST['thn_ajaran'];

    $insert = mysqli_query($conn, "UPDATE skripsi081 SET judul_skripsi081='$Judul_skripsi', topik081='$Topik', semester081='$Semester', thn_ajaran081='$Thn_ajaran' WHERE skripsi081='$Id_skripsi'");

    if ($insert) {
        echo '<div class="alert alert-info-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=skripsi081">';
    } else {
        echo '<div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Gagal Disimpan</h4></div>';
    }
}
?>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="card-body p-2">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="id_skripsi">Kode Skripsi</label>
                            <input type="text" name="id_skripsi" value="<?= $edit['skripsi081']; ?>" class="form-control"
                                readonly>
                        </div>

                        <div class="form-group">
                            <label for="judul_skripsi">Judul Skripsi</label>
                            <input type="text" name="judul_skripsi" value="<?= $edit['judul_skripsi081']; ?>" id="judul_skripsi081"
                                placeholder="Judul skripsi" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="topik081">Topik</label>
                            <input type="text" name="topik081" value="<?= $edit['topik081']; ?>" id="topik081"
                                placeholder="Topik" class="form-control">
                        </div>

                    <div class="form-group">
                        <label>Semester</label>
                        <select name="semester" class="form-control">
                            <option value="ganjil" <?= $edit['semester081'] == 'ganjil' ? 'selected' : '' ?>>Ganjil</option>
                            <option value="genap" <?= $edit['semester081'] == 'genap' ? 'selected' : '' ?>>Genap</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tahun Ajaran</label>
                        <select name="thn_ajaran" class="form-control">
                            <option value="2025/2026" <?= $edit['thn_ajaran081'] == '2025/2026' ? 'selected' : '' ?>>2025/2026</option>
                            <option value="2026/2027" <?= $edit['thn_ajaran081'] == '2026/2027' ? 'selected' : '' ?>>2026/2027</option>
                        </select>
                    </div>

                        <div class="card-footer">
                            <input type="submit" class="btn btn-primary" name="tambah" value="Update">
                            <a href="index.php?page=skripsi081" class="btn btn-secondary">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>