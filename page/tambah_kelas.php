<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Data Kelas</h1>
            </div>
        </div>
    </div>
</div>
<?php
include "config/koneksi.php";
//kode otomatis
$carikode = mysqli_query($conn,"select max(Id_Kelas) from Kelas") or die (mysqli_error($conn));
$datakode = mysqli_fetch_array($carikode);
if($datakode) {
    $nilaikode = substr($datakode[0], 2);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
}

if(isset($_POST['tambah'])){
    $Id_kelas = $_POST['Id_kelas'];
    $Nm_kelas = $_POST['Nm_kelas'];

    $insert = mysqli_query($conn, "INSERT INTO Kelas values ('$Id_kelas','$Nm_kelas')");
    
    if ($insert) {
        echo '<div class="alert alert-info-dismissible">
        <button type="button" class="close" data-dismiss="alert"
            aria-hidden="true">×</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=kelas">';
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
                            <label for="Id_kelas">Kode Kelas</label>
                            <input type="text" name="Id_kelas" placeholder="Id Kelas" class="form-control" >
                        </div>

                        <div class="form-group">
                            <label for="Nm_kelas">Nama Kelas</label>
                            <input type="text" name="Nm_kelas" id="Nm_kelas" placeholder="Nama Kelas" class="form-control">
                        </div>

                        <div class="card-footer">
                            <input type="submit" class="btn btn-primary" name="tambah" value="Simpan">
                            <a href="index.php?page=kelas" class="btn btn-secondary">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>