<?php
include "config/koneksi.php";

$jml_siswa = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM siswa"))['total'];
$jml_kelas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM kelas"))['total'];

$hari = date("l");
$hariIndo = [
    "Monday"=>"Senin","Tuesday"=>"Selasa","Wednesday"=>"Rabu",
    "Thursday"=>"Kamis","Friday"=>"Jumat","Saturday"=>"Sabtu","Sunday"=>"Minggu"
];
$hariSekarang = $hariIndo[$hari];

$jam = date("H:i:s");

$queryJadwal = mysqli_query($conn, "
SELECT 
    dk.*,
    k.nm_kelas,
    m.nm_mapel,
    g.nm_guru
FROM detail_jadwal dk
JOIN jadwal_kelas jk ON dk.id_jadwal = jk.id_jadwal
JOIN kelas k ON jk.id_kelas = k.id_kelas
JOIN mapel m ON dk.kd_mapel = m.kd_mapel
JOIN guru g ON dk.kd_guru = g.kd_guru
WHERE dk.hari='$hariSekarang'
AND '$jam' BETWEEN dk.jam_mulai AND dk.jam_selesai
");
?>

<div class="row">

<div class="col-lg-3 col-6">
<div class="small-box bg-info">
<div class="inner">
<h3><?= $jml_siswa; ?></h3>
<p>Jumlah Siswa</p>
</div>
<div class="icon">
<i class="fas fa-users"></i>
</div>
</div>
</div>

<div class="col-lg-3 col-6">
<div class="small-box bg-success">
<div class="inner">
<h3><?= $jml_kelas; ?></h3>
<p>Jumlah Kelas</p>
</div>
<div class="icon">
<i class="fas fa-school"></i>
</div>
</div>
</div>

<div class="col-lg-6">
<div class="card">
<div class="card-header">
<h3 class="card-title">Jadwal Sedang Berlangsung</h3>
</div>
<div class="card-body">
<table class="table table-bordered">
<tr>
<th>Kelas</th>
<th>Mapel</th>
<th>Guru</th>
<th>Jam</th>
</tr>

<?php if(mysqli_num_rows($queryJadwal) > 0){ ?>
<?php while($row = mysqli_fetch_assoc($queryJadwal)){ ?>
<tr>
<td><?= $row['nm_kelas']; ?></td>
<td><?= $row['nm_mapel']; ?></td>
<td><?= $row['nm_guru']; ?></td>
<td><?= $row['jam_mulai']; ?> - <?= $row['jam_selesai']; ?></td>
</tr>
<?php } ?>
<?php } else { ?>
<tr>
<td colspan="4" class="text-center">Tidak ada jadwal sekarang</td>
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
<h3 class="card-title">Profile User</h3>
</div>
<div class="card-body">
<p><b>Username:</b> <?= $_SESSION['username']; ?></p>
<p><b>Status:</b> Admin</p>
<p><b>Login Time:</b> <?= date("d-m-Y H:i:s"); ?></p>
</div>
</div>
</div>
</div>