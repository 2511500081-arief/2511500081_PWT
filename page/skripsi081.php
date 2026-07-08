<?php
include "config/koneksi.php";
require_once "config/auth.php";
cek_login();

// PROTEKSI HAPUS
if (isset($_GET['action']) && $_GET['action'] == "hapus") {

    if (!is_admin()) {
        echo "Akses ditolak!";
        exit;
    }

    $kd = $_GET['kd'];
    $query = mysqli_query($conn, "DELETE FROM skripsi081 WHERE skripsi081='$kd'");

    if ($query) {
        echo "<div class='alert alert-warning'>Berhasil Di Hapus</div>";
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=skripsi081">';
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <?php if (is_admin()) { ?>
                    <a href="index.php?page=tambah_skripsi081" class="btn btn-primary btn-sm mb-3">
                        Tambah Skripsi
                    </a>
                <?php } ?>

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <td>NO</td>
                            <td>Id Skripsi</td>
                            <td>Judul Skripsi</td>
                            <td>Topik</td>
                            <td>Semester</td>
                            <td>Tahun Ajaran</td>
                            <?php if (is_admin()) { ?>
                            <td>Aksi</td>
                            <?php } ?>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 0;
                        $query = mysqli_query($conn, "SELECT * FROM skripsi081");
                        while ($result = mysqli_fetch_array($query)) {
                            $no++;
                            ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $result['skripsi081']; ?></td>
                                <td><?= $result['judul_skripsi081']; ?></td>
                                <td><?= $result['topik081']; ?></td>
                                <td><?= $result['semester081']; ?></td>
                                <td><?= $result['thn_ajaran081']; ?></td>

                                <?php if (is_admin()) { ?>
                                    <td>
                                        <a href="index.php?page=skripsi081&action=hapus&kd=<?= $result['skripsi081'] ?>"
                                            onclick="return confirm('Yakin ingin hapus?')">
                                            <span class="badge badge-danger">Hapus</span>
                                        </a>

                                        <a href="index.php?page=edit_skripsi081&kd=<?= $result['skripsi081'] ?>">
                                            <span class="badge badge-warning">Edit</span>
                                        </a>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>

            </div>
        </div>
    </div>
</div>