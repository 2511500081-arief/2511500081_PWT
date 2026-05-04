<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Data Siswa</h1>
            </div>
        </div>
    </div>
</div>
<?php
include "config/koneksi.php";
//kode otomatis
$carikode = mysqli_query($conn,"select max(nis) from siswa") or die (mysqli_error($conn));
$datakode = mysqli_fetch_array($carikode);
if($datakode[0] != NULL) {
    $nilaikode = substr($datakode[0], 2);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode = "00" . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "001";
}

if(isset($_POST['tambah'])){
    $nis = $_POST['nis'];
    $id_user = $_POST['id_user'];
    $nm_siswa = $_POST['nm_siswa'];
    $jenkel = $_POST['jenkel'];
    $hp = $_POST['hp'];
    $id_kelas = $_POST['id_kelas'];

    $insert = mysqli_query($conn, "INSERT INTO siswa values ('$nis','$id_user','$nm_siswa','$jenkel','$hp','$id_kelas')");
    $insertuser = mysqli_query($conn, "INSERT INTO admin (username, password, role) values ('$nis','12345','siswa')");

    if ($insert && $insertuser) {
        echo '<div class="alert alert-info-dismissible">
        <button type="button" class="close" data-dismiss="alert"
            aria-hidden="true">×</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=siswa">';
    } else {
        echo '<div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"
            aria-hidden="true">×</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Nis sudah dipakai, Gagal Disimpan</h4></div>';
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
                            <label for="nis">NIS</label>
                            <input type="text" name="nis" id="nis" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="id_user">ID User</label>
                            <input type="number" name="id_user" id="id_user" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="nm_siswa">Nama Siswa</label>
                            <input type="text" name="nm_siswa" id="nm_siswa" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="jenkel">Jenis Kelamin</label>
                            <select name="jenkel" id="jenkel" class="form-control">
                                <option value="">-- Pilih --</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="hp">No HP</label>
                            <input type="text" name="hp" id="hp" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="id_kelas">ID Kelas</label>
                            <select type="text" name="id_kelas" id="id_kelas" class="form-control">
                                <option value="">-- Pilih --</option>
                                <?php
                                $query = mysqli_query($conn, "SELECT * FROM kelas");
                                while ($result = mysqli_fetch_array($query)) {
                                    echo "<option value='" . $result['id_kelas'] . "'>" . $result['nm_kelas'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="card-footer">
                            <input type="submit" class="btn btn-primary" name="tambah" value="Simpan">
                            <a href="index.php?page=siswa" class="btn btn-secondary">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>