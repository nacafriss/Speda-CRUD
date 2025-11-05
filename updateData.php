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
    <?php
    include "config/koneksi.php";
    $id = $_GET['id'];
    $sql = "SELECT * FROM mahasiswa WHERE id='$id'";
    $result = mysqli_query($koneksi, $sql);
    $data = mysqli_fetch_assoc($result);
    ?>

    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body " data-bs-theme="dark">
        <div class="container w-75">
            <a class="navbar-brand" href="#"><img src="assets/logo.png" alt="Speda" width="30" height="25">Speda</a>
            <button class="navbar-toggler justify-content-end" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="tambahMhs.php">Tambah Mahasiswa</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container w-75 mt-5">
        <h2>Update Data Mahasiswa</h2>
        <form action="logic/update.php" method="POST">
            <input type="text" name="id" value="<?= $data['id'] ?>" hidden>
            <div class="mb-3">
                <label for="NIM" class="form-label">NIM</label>
                <input type="number" class="form-control" id="NIM" name="NIM" value="<?= $data['nim'] ?>">
            </div>
            <div class="mb-3">
                <label for="Nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="Nama" name="Nama" value="<?= $data['nama'] ?>">
            </div>
            <fieldset class="mb-3">
                <span class="form-label fs-6">Jenis Kelamin</span>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="Jenis_Kelamin" id="Laki-Laki" value="Laki-Laki" <?= ($data['jenis_kelamin'] == 'Laki-Laki') ? 'checked' : '' ?>>
                    <label class="form-check-label" for="Laki-Laki">
                        Laki-Laki
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="Jenis_Kelamin" id="Perempuan" value="Perempuan" <?= ($data['jenis_kelamin'] == 'Perempuan') ? 'checked' : '' ?>>

                    <label class="form-check-label" for="Perempuan">
                        Perempuan
                    </label>
                </div>
            </fieldset>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</body>

</html>