<?php

require_once "config/auth.php";
hanya_admin();
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Skripsi</h1>
            </div>
        </div>
    </div>
</div>
<?php
include "config/koneksi.php";
//kode otomatis
$carikode = mysqli_query($conn, "select max(skripsi081) from skripsi081") or die(mysqli_error($conn));
$datakode = mysqli_fetch_array($carikode);


if (isset($_POST['tambah'])) {
    $id_skripsi = $_POST['skripsi081'];
    $judul_skripsi = $_POST['judul_skripsi'];
    $topik = $_POST['topik081'];
    $semester = $_POST['semester081'];
    $thn_ajaran = $_POST['thn_ajaran081'];
    $insert = mysqli_query($conn, "INSERT INTO skripsi081 values ('$id_skripsi','$judul_skripsi','$topik','$semester','$thn_ajaran')");

    if ($insert) {
        echo '<div class="alert alert-info-dismissible">
        <button type="button" class="close" data-dismiss="alert"
            aria-hidden="true">×</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=skripsi081">';
    } else {
        echo '<div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"
            aria-hidden="true">×</button>
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
                            <label for="skripsi081">Id Skripsi</label>
                            <input type="text" name="skripsi081" placeholder="Id Skripsi" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="judul_skripsi">Judul Skripsi</label>
                            <input type="text" name="judul_skripsi" id="judul_skripsi" placeholder="Judul Skripsi"
                                class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="topik081">Topik</label>
                            <input type="text" name="topik081" id="topik081" placeholder="Topik" class="form-control">
                        </div>

                        <div class="form-group">
                        <label>Semester</label>
                        <select name="semester" class="form-control">
                            <option value="ganjil" <?=['semester081'] == 'ganjil' ? 'selected' : '' ?>>Ganjil</option>
                            <option value="genap" <?= ['semester081'] == 'genap' ? 'selected' : '' ?>>Genap</option>
                        </select>
                        </div>

                        <div class="form-group">
                        <label>Tahun Ajaran</label>
                        <select name="thn_ajaran" class="form-control">
                            <option value="2025/2026" <?= ['thn_ajaran081'] == '2025/2026' ? 'selected' : '' ?>>2025/2026</option>
                            <option value="2026/2027" <?= ['thn_ajaran081'] == '2026/2027' ? 'selected' : '' ?>>2026/2027</option>
                        </select>
                        </div>

                        <div class="card-footer">
                            <input type="submit" class="btn btn-primary" name="tambah" value="Simpan">
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