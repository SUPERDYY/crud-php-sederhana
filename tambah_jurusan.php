<?php include 'layout/header.php' ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="data_jurusan.php">Data Jurusan</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Jurusan</li>
    </ol>
</nav>

<form method="POST" action="" class="card">
    <div class="card-header">
        Form Jurusan
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-3">
                <label for="">Nama Jurusan</label>
            </div>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="nama_jurusan" placeholder="Masukkan nama jurusan...">
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button name="simpan" class="btn btn-success">Simpan Data</button>
        <a href="data_jurusan.php" class="btn btn-danger">Kembali</a>
    </div>
</form>

<?php

include 'layout/footer.php';
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $nama_jurusan = $_POST['nama_jurusan'];

    $simpan = mysqli_query($toll, "INSERT INTO data_jurusan
    values(null, '$nama_jurusan')");

    if ($simpan) {
        echo '<script>
        alert("data berhasil disimpan");
        window.location.href="data_jurusan.php";
        </script>';
    }
}

?>