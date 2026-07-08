<?php
include "config/koneksi.php";

if (isset($_POST['ubah'])) {
    $lama = trim($_POST['password_lama']);
    $baru = trim($_POST['password_baru']);
    $konfirmasi = trim($_POST['konfirmasi']);

    if ($baru != $konfirmasi) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>Swal.fire({icon:'warning',title:'Konfirmasi tidak cocok'});</script>";
    } else {

        if ($_SESSION['role'] == "admin") {
            $username = $_SESSION['username'];
            $cek = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$lama'");
            if (mysqli_num_rows($cek)) {
                mysqli_query($conn, "UPDATE admin SET password='$baru' WHERE username='$username'");
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>Swal.fire({icon:'success',title:'Berhasil',text:'Password berhasil diubah'}).then(()=>location='logout.php');</script>";
            } else {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>Swal.fire({icon:'error',title:'Password lama salah'});</script>";
            }
        }

        if ($_SESSION['role'] == "siswa") {
            $nis = $_SESSION['nis'];
            $cek = mysqli_query($conn, "SELECT * FROM siswa WHERE nis='$nis' AND password='$lama'");
            if (mysqli_num_rows($cek)) {
                mysqli_query($conn, "UPDATE siswa SET password='$baru' WHERE nis='$nis'");
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>Swal.fire({icon:'success',title:'Berhasil',text:'Password berhasil diubah'}).then(()=>location='logout.php');</script>";
            } else {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>Swal.fire({icon:'error',title:'Password lama salah'});</script>";
            }
        }
    }
}
?>
<div class="card card-primary shadow">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-key"></i> Ubah Password</h3>
    </div>
    <form method="post">
        <div class="card-body">
            <div class="form-group">
                <label>Password Lama</label>
                <div class="input-group">
                    <input type="password" id="lama" name="password_lama" class="form-control" required>
                    <div class="input-group-append"><span class="input-group-text" onclick="toggle('lama')"
                            style="cursor:pointer"><i class="fas fa-eye"></i></span></div>
                </div>
            </div>
            <div class="form-group">
                <label>Password Baru</label>
                <div class="input-group">
                    <input type="password" id="baru" name="password_baru" class="form-control" required>
                    <div class="input-group-append"><span class="input-group-text" onclick="toggle('baru')"
                            style="cursor:pointer"><i class="fas fa-eye"></i></span></div>
                </div>
                <small id="strength"></small>
            </div>
            <div class="form-group">
                <label>Konfirmasi Password</label>
                <div class="input-group">
                    <input type="password" id="konfirmasi" name="konfirmasi" class="form-control" required>
                    <div class="input-group-append"><span class="input-group-text" onclick="toggle('konfirmasi')"
                            style="cursor:pointer"><i class="fas fa-eye"></i></span></div>
                </div>
                <small id="match"></small>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" name="ubah"><i class="fas fa-save"></i> Simpan Password</button>
        </div>
    </form>
</div>
<script>
    function toggle(id) {
        let x = document.getElementById(id);
        x.type = x.type === "password" ? "text" : "password";
    }
    const b = document.getElementById("baru");
    const k = document.getElementById("konfirmasi");
    b.addEventListener("keyup", () => {
        let t = "Lemah", c = "red";
        if (b.value.length >= 10) { t = "Kuat"; c = "green"; }
        else if (b.value.length >= 6) { t = "Sedang"; c = "orange"; }
        let s = document.getElementById("strength");
        s.innerHTML = t; s.style.color = c;
    });
    k.addEventListener("keyup", () => {
        let m = document.getElementById("match");
        if (k.value === b.value) { m.innerHTML = "✔ Password cocok"; m.style.color = "green"; }
        else { m.innerHTML = "✖ Password belum cocok"; m.style.color = "red"; }
    });
</script>