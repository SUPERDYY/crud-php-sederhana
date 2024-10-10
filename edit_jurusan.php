<?php

include 'layout/header.php';
include 'koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($toll, "SELECT * FROM data_jurusan where id_jurusan = '$id'");
$get = mysqli_fetch_array($query);

?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="data_jurusan.php">Data Jurusan</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Jurusan</li>
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
                <input type="text" class="form-control" value="<?= $get['nama_jurusan'] ?>" name="nama_jurusan" placeholder="Masukkan nama jurusan...">
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button name="edit" class="btn btn-success">Edit Data</button>
        <a href="data_jurusan.php" class="btn btn-danger">Kembali</a>
    </div>
</form>

<?php

include 'layout/footer.php';

if (isset($_POST['edit'])) {
    $id = $_GET['id'];
    $nama_jurusan = $_POST['nama_jurusan'];

    $simpan = mysqli_query($toll, "UPDATE data_jurusan
    SET nama_jurusan = '$nama_jurusan'
    where id_jurusan = '$id'");

    if ($simpan) {
        echo '<script>
        alert("data berhasil di edit");
        window.location.href="data_jurusan.php";
        </script>';
    }
}

?>