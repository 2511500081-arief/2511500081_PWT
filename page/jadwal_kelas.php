<?php
include "config/koneksi.php";
require_once "config/auth.php";
cek_login();

// ================= PROTEKSI HAPUS =================
if (isset($_GET['action']) && $_GET['action'] == "hapus") {

  if (!is_admin()) {
    echo "Akses ditolak!";
    exit;
  }

  $kd = $_GET['kd'];

  // FIX: pakai id_jadwal, bukan nis
  $query = mysqli_query($conn, "DELETE FROM jadwal_kelas WHERE id_jadwal='$kd'");

  if ($query) {
    echo "<div class='alert alert-warning'>Berhasil Di Hapus</div>";
    echo '<meta http-equiv="refresh" content="1;url=index.php?page=jadwal_kelas">';
  }
}
?>

<div class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">

        <!-- TOMBOL TAMBAH HANYA ADMIN -->
        <?php if (is_admin()) { ?>
          <a href="index.php?page=tambah_jadwal" class="btn btn-primary btn-sm">
            Tambah Jadwal
          </a>
        <?php } ?>

        <br><br>

        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <td>No</td>
              <td>ID Jadwal</td>
              <td>ID Kelas</td>
              <td>Tahun Ajaran</td>
              <td>Semester</td>

              <!-- KOLOM AKSI HANYA ADMIN -->
              <?php if (is_admin()) { ?>
                <td>Aksi</td>
              <?php } ?>
            </tr>
          </thead>

          <tbody>
            <?php
            $no = 0;
            $query = mysqli_query($conn, "SELECT * FROM jadwal_kelas");

            while ($result = mysqli_fetch_array($query)) {
              $no++;
              ?>
              <tr>
                <td><?= $no; ?></td>
                <td><?= $result['id_jadwal']; ?></td>
                <td><?= $result['id_kelas']; ?></td>
                <td><?= $result['thn_ajaran']; ?></td>
                <td><?= $result['semester']; ?></td>

                <!-- AKSI HANYA ADMIN -->
                <?php if (is_admin()) { ?>
                  <td>

                    <a href="index.php?page=jadwal_kelas&action=hapus&kd=<?= $result['id_jadwal']; ?>"
                      onclick="return confirm('Yakin ingin hapus?')">
                      <span class="badge badge-danger">Hapus</span>
                    </a>

                    <a href="index.php?page=edit_jadwal&kd=<?= $result['id_jadwal']; ?>">
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