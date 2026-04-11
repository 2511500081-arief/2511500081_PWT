<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0 text-dark">Data mapel</h1>
            </div>
        </div>
    </div>
</div>

<?php
include "config/koneksi.php";
$cari = $_GET['cari'] ?? '';

// PAGINATION
$limit = 5;
$hal = $_GET['hal'] ?? 1;
$offset = ($hal - 1) * $limit;

// QUERY
if ($cari != '') {
    $stmt = mysqli_prepare($conn, "SELECT * FROM mapel WHERE nm_mapel LIKE ? LIMIT ? OFFSET ?");
    $search = "%$cari%";
    mysqli_stmt_bind_param($stmt, "sii", $search, $limit, $offset);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} else {
    $result = mysqli_query($conn, "SELECT * FROM mapel LIMIT $limit OFFSET $offset");
}

// TOTAL DATA
$total = mysqli_query($conn, "SELECT COUNT(*) as total FROM mapel");
$dataTotal = mysqli_fetch_assoc($total);
$totalData = $dataTotal['total'];
$totalHal = ceil($totalData / $limit);

if (isset($_GET['action']) && $_GET['action'] == "hapus") {
    $kd = $_GET['kd'];
    $query = mysqli_query($conn, "DELETE FROM mapel WHERE kd_mapel='$kd'");

    if ($query) {
        echo "<div class='alert alert-warning'>Berhasil Di Hapus</div>";
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=mapel">';
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                
                <a href="index.php?page=tambah_mapel" class="btn btn-primary btn-sm mb-3">
                    Tambah Mapel
                </a>
                <form method="GET">
                    <input type="hidden" name="page" value="mapel">
                    <input type="text" name="cari" class="form-control mb-2" placeholder="Cari...">
                </form>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Kd mapel</th>
                            <th>Nama mapel</th>
                            <th>KKM</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 0;
                        $query = mysqli_query($conn, "SELECT * FROM mapel");
                        while ($result = mysqli_fetch_array($query)) {
                            $no++;
                        ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $result['kd_mapel']; ?></td>
                            <td><?= $result['nm_mapel']; ?></td>
                            <td><?= $result['kkm']; ?></td>
                            <td>
                                <a href="index.php?page=mapel&action=hapus&kd=<?= $result['kd_mapel'] ?>">
                                    <span class="badge badge-danger">Hapus</span>
                                </a>

                                <a href="index.php?page=edit_mapel&kd=<?= $result['kd_mapel'] ?>">
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