<?php
require_once __DIR__ . "/../config/koneksi.php";
?>

<div class="content-header">
  <div class="container-fluid">
    <h1>Data kelas</h1>
  </div>
</div>

<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "hapus") {
        $kd = $_GET['kd'];

        $query = mysqli_query($conn, "DELETE FROM jadwal_kelas WHERE id_jadwal = '$kd'");

        if ($query) {
            echo '<div class="alert alert-warning">Berhasil Dihapus</div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=jadwal_kelas">';
        }
    }
}
?>

<div class="content">
<div class="container-fluid">
<div class="card">
<div class="card-body">

<a href="index.php?page=tambah_jadwal" class="btn btn-primary btn-sm">
  Tambah jadwal
</a>

<br><br>

<table class="table table-striped">
<thead>
<tr>
  <th>no</th>
  <th>id jadwal</th>
  <th>id kelas</th>
  <th>tahun ajaran</th>
  <th>semester</th>
  <th>aksi</th>
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
  <td>

    <a href="index.php?page=jadwal_kelas&action=hapus&kd=<?= $result['id_jadwal']; ?>"
       onclick="return confirm('Yakin ingin hapus?')">
      <span class="badge badge-danger">Hapus</span>
    </a>

    <a href="index.php?page=edit_jadwal&kd=<?= $result['id_jadwal']; ?>">
      <span class="badge badge-warning">Edit</span>
    </a>

  </td>
</tr>
<?php } ?>
</tbody>

</table>

</div>
</div>
</div>
</div>