<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Data Siswa</h1>
            </div>
        </div>
    </div>
</div>

<?php
include "config/koneksi.php";
$kd = $_GET['kd'];
$edit = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM Siswa WHERE Nis='$kd'"));

if(isset($_POST['tambah'])){
    $Nis = $_POST['Nis'];
    $Id_user = $_POST['Id_user'];
    $Nm_siswa = $_POST['Nm_siswa'];
    $Jenkel = $_POST['Jenkel'];
    $Hp = $_POST['Hp'];
    $Id_kelas = $_POST['Id_kelas'];

    $insert = mysqli_query($conn, "UPDATE Siswa SET Id_user='$Id_user', Nm_siswa='$Nm_siswa', Jenkel='$Jenkel', Hp='$Hp', Id_kelas='$Id_kelas' WHERE Nis='$Nis'");

    if ($insert) {
        echo '<div class="alert alert-info-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=siswa">';
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
            <div class="card-body p-2">
                <form method="POST" action="">

                    <div class="form-group">
                        <label>NIS</label>
                        <input type="text" name="Nis" value="<?= $edit['Nis']; ?>" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label>ID User</label>
                        <input type="number" name="Id_user" value="<?= $edit['Id_user']; ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Nama Siswa</label>
                        <input type="text" name="Nm_siswa" value="<?= $edit['Nm_siswa']; ?>" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="Jenkel" class="form-control">
                            <option value="">-- Pilih --</option>
                            <option value="L" <?= ($edit['Jenkel'] == 'L') ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="P" <?= ($edit['Jenkel'] == 'P') ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>No HP</label>
                        <input type="text" name="Hp" value="<?= $edit['Hp']; ?>" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label>ID Kelas</label>
                        <input type="number" name="Id_kelas" value="<?= $edit['Id_kelas']; ?>" class="form-control">
                    </div>

                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary" name="tambah" value="Simpan">
                        <a href="index.php?page=siswa" class="btn btn-secondary">Batal</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>