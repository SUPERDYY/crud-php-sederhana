<?php 

include 'layout/header.php';
include 'koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($toll, "SELECT * FROM data_operator where id_operator = '$id'");
$get = mysqli_fetch_array($query);

?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="data_operator.php">Data Operator</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Operator</li>
    </ol>
</nav>

<form method="POST" action="" class="card">
    <div class="card-header">
        Form Operator
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-3">
                <label for="">Nama Operator</label>
            </div>
            <div class="col-lg-9">
                <input type="text" class="form-control" value="<?= $get['nama_operator'] ?>" name="nama_operator" placeholder="Masukkan nama operator...">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-3">
                <label for="">Alamat Email</label>
            </div>
            <div class="col-lg-9">
                <input type="email" class="form-control" value="<?= $get['email_operator'] ?>" name="email_operator" placeholder="Masukkan alamat email...">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-3">
                <label for="">Password</label>
            </div>
            <div class="col-lg-9">
                <input type="password" class="form-control" value="<?= $get['password_operator'] ?>" name="password_operator" placeholder="Masukkan Password...">
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button name="edit" class="btn btn-success">Edit Data</button>
        <a href="data_operator.php" class="btn btn-danger">Kembali</a>
    </div>
</form>

<?php

include 'koneksi.php';

$nimValue = '';

if (isset($_POST['edit'])) {
    $nim = $_POST['password_operator'];

    $cekNIM = mysqli_query($toll, "SELECT * FROM data_operator WHERE password_operator = '$nim'");
    if (mysqli_num_rows($cekNIM) > 0) {
        $nimValue = $nim;
    } else {
        $nama_operator = $_POST['nama_operator'];
        $email_operator = $_POST['email_operator'];
        $password_operator = $_POST['password_operator'];

        $edit = mysqli_query($toll, "UPDATE data_operator SET
        nama_operator = '$nama_operator',
        email_operator = '$email_operator',
        password_operator = '$password_operator'
        where id_operator = '$id'");

        if (!$edit) {
            echo '<script>
            alert("Gagal mengedit data operator.");
            window.location.href="data_operator.php";
            </script>';
            exit;
        } else {
            echo '<script>
            alert("Data operator berhasil diedit.");
            window.location.href="data_operator.php";
          </script>';
            exit;
        }
    }
}

mysqli_close($toll);

?>

<?php if (!empty($nimValue)) : ?>
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        <strong>Data Gagal Mengedit! </strong> Password <strong><?= $nimValue ?> </strong>Sudah digunakan.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif ?>

<?php include 'layout/footer.php' ?>