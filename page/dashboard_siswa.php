<?php
include "config/koneksi.php";

$username = $_SESSION['username'];

$querySiswa = mysqli_query($conn, "SELECT * FROM siswa WHERE Nis='$username'");
$dataSiswa = mysqli_fetch_assoc($querySiswa);

$hari = date("l");
$hariIndo = [
    "Monday"=>"Senin","Tuesday"=>"Selasa","Wednesday"=>"Rabu",
    "Thursday"=>"Kamis","Friday"=>"Jumat","Saturday"=>"Sabtu","Sunday"=>"Minggu"
];
$hariSekarang = $hariIndo[$hari];

$jam = date("H:i:s");

$queryJadwal = mysqli_query($conn, "
SELECT dk.*, m.nama_mapel, g.nama_guru
FROM detail_jadwal dk
JOIN mapel m ON dk.kd_mapel = m.kd_mapel
JOIN guru g ON dk.kd_guru = g.kd_guru
WHERE dk.hari='$hariSekarang'
AND '$jam' BETWEEN dk.jam_mulai AND dk.jam_selesai
");
?>

<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h3 class="card-title">Jadwal Saya Sekarang</h3>
</div>
<div class="card-body">

<table class="table table-bordered">
<tr>
<th>Mapel</th>
<th>Guru</th>
<th>Jam</th>
</tr>

<?php if(mysqli_num_rows($queryJadwal) > 0){ ?>
<?php while($row = mysqli_fetch_assoc($queryJadwal)){ ?>
<tr>
<td><?= $row['nama_mapel']; ?></td>
<td><?= $row['nama_guru']; ?></td>
<td><?= $row['jam_mulai']; ?> - <?= $row['jam_selesai']; ?></td>
</tr>
<?php } ?>
<?php } else { ?>
<tr>
<td colspan="3" class="text-center">Tidak ada jadwal</td>
</tr>
<?php } ?>

</table>

</div>
</div>
</div>
</div>

<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h3 class="card-title">Profile</h3>
</div>
<div class="card-body">
<p><b>NIS:</b> <?= $dataSiswa['Nis']; ?></p>
<p><b>Nama:</b> <?= $dataSiswa['Nm_siswa']; ?></p>
<p><b>Kelas:</b> <?= $dataSiswa['Id_kelas']; ?></p>
</div>
</div>
</div>
</div>