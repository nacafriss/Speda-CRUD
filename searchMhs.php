<?php
include "config/koneksi.php";
$error = "";
$result = false;
$cari = "";

if (isset($_GET['cari'])) {
    $cari = trim($_GET['cari']);
    $cari = mysqli_real_escape_string($koneksi, $cari);
    if ($cari === "") {
       header ("location: index.php");
        $result = true;
    } else {
        $sql = "SELECT * FROM mahasiswa 
                WHERE nama LIKE '%$cari%'";
        $result = mysqli_query($koneksi, $sql);

        if (!$result) {
            $error = "Terjadi kesalahan pada query: " . mysqli_error($koneksi);
        } elseif (mysqli_num_rows($result) === 0) {
            $error = "Tidak ada hasil ditemukan untuk kata kunci '<b>$cari</b>'.";
        }
    }
} else {
    $error = "Mahasiswa yang di cari tidak ditemukan!";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Speda</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body " data-bs-theme="dark">
        <div class="container w-75">
            <a class="navbar-brand" href="#"><img src="assets/logo.png" alt="Speda" width="35" height="30">Speda</a>
            <button class="navbar-toggler justify-content-end" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tambahMhs.php">Tambah Mahasiswa</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container w-75 mt-5">
        <h2>Daftar Mahasiswa</h2>
        <form class="input-group " role="search" method="GET" action="searchMhs.php">
            <input type="search" class="form-control" placeholder="Cari Mahasiswa" aria-label="Cari Mahasiswa" name="cari" value="<?= isset($_GET['cari']) ? $_GET['cari'] : '' ?>">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
        </form>
        <div class="table-responsive mt-3">
            <table class="table table-dark table-striped-columns text-nowrap">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">NIM</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($error): ?>
                        <tr>
                            <td colspan="5"><?= $error ?></td>
                        </tr>
                    <?php elseif ($result && mysqli_num_rows($result) > 0): ?>

                        <?php
                        $i = 1;
                        while ($data = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $data['nim'] ?></td>
                                <td><?= $data['nama'] ?></td>
                                <td><?= $data['jenis_kelamin'] ?></td>
                                <td>
                                    <a href="updateData.php?id=<?= $data['id'] ?>"> <button type="button" class="btn btn-primary btn-sm">Update</button></a>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="showPopup(<?= $data['id'] ?>, '<?= $data['nama'] ?>')">Delete</button>
                                </td>
                            </tr>
                        <?php endwhile ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5">Tidak ada data mahasiswa!</td>
                        </tr>
                    <?php endif ?>

                </tbody>
            </table>
        </div>
    </div>

    <div id="popupOverlay" class="popup-overlay">
        <div class="popup">
            <div class="popup-header">
                <h3>Hapus Data</h3>
            </div>
            <div class="popup-body">
                <p>Apakah Anda yakin ingin menghapus data mahasiswa dengan nama <b id="namaMahasiswa"></b>?</p>
            </div>
            <div class="popup-footer">
                <button class="btn-danger" onclick="hapusData()">Hapus</button>
                <button class="btn-secondary" onclick="closePopup()">Batal</button>
            </div>
        </div>
    </div>

    <script>
        let selectedId = null;

        function showPopup(id, nama) {
            selectedId = id;
            document.getElementById("namaMahasiswa").textContent = nama;
            document.getElementById("popupOverlay").style.display = "flex";
        }

        function closePopup() {
            document.getElementById("popupOverlay").style.display = "none";
            selectedId = null;
        }

        function hapusData() {
            if (selectedId) {
                window.location.href = "logic/delete.php?id=" + selectedId;
            }
        }
    </script>
</body>

</html>