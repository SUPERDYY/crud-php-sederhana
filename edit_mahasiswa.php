<?php

include 'layout/header.php';
include 'koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($toll, "SELECT * FROM data_mahasiswa where id_mhs = '$id'");
$get = mysqli_fetch_array($query);
$option2 = mysqli_query($toll, "SELECT * FROM data_jurusan")

?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="data_mahasiswa.php">Data Mahasiswa</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Mahasiswa</li>
    </ol>
</nav>

<form method="POST" action="" class="card">
    <div class="card-header">
        Form Mahasiswa
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-3">
                <label for="">NIM Mahasiswa</label>
            </div>
            <div class="col-lg-9">
                <input type="text" class="form-control" value="<?= $get['nim_mhs'] ?>" name="nim_mahasiswa" placeholder="Masukkan nomor induk mahasiswa...">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-3">
                <label for="">Nama Mahasiswa</label>
            </div>
            <div class="col-lg-9">
                <input type="text" class="form-control" value="<?= $get['nama_mhs'] ?>" name="nama_mahasiswa" placeholder="Masukkan nama lengkap mahasiswa...">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-3">
                <label for="">Tanggal Lahir</label>
            </div>
            <div class="col-lg-9">
                <input type="date" class="form-control" value="<?= $get['tgl_lahir'] ?>" name="tgl_lahir">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-3">
                <label for="">Jenis Kelamin</label>
            </div>
            <div class="col-lg-9">
            <select class="form-select" name="jenis_kelamin" aria-label="Default select example">
                    <option selected disabled>Pilih Jenis Kelamin...</option>
                    <option value="laki-laki" <?= $get['jenis_kelamin'] == "laki-laki" ? "selected" : "" ?>>Laki-Laki</option>
                    <option value="perempuan" <?= $get['jenis_kelamin'] == "perempuan" ? "selected" : "" ?>>Perempuan</option>
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-3">
                <label for="">Jurusan</label>
            </div>
            <div class="col-lg-9">
                <select class="form-select" name="id_jurusan" aria-label="Default select example">
                    <option selected disabled>Pilih Jurusan...</option>
                    <?php foreach ($option2 as $row) : ?>
                        <?php if($row['id_jurusan'] == $get['id_jurusan'] ) : ?>
                            <option value="<?= $row['id_jurusan'] ?>" selected><?= $row['nama_jurusan'] ?></option>
                            <?php else : ?>
                                <option value="<?= $row['id_jurusan'] ?>"><?= $row['nama_jurusan'] ?></option>
                        <?php endif ?>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button name="edit" class="btn btn-success">Edit Data</button>
        <a href="data_mahasiswa.php" class="btn btn-danger">Kembali</a>
    </div>
</form>

<?php

include 'koneksi.php';

$nimValue = '';

if (isset($_POST['edit'])) {
    $nim = $_POST['nim_mahasiswa'];

    $cekNIM = mysqli_query($toll, "SELECT * FROM data_mahasiswa WHERE nim_mhs = '$nim'");
    if (mysqli_num_rows($cekNIM) > 0) {
        $nimValue = $nim;
    } else {
        $id = $_GET['id'];
        $nim_mahasiswa = $_POST['nim_mahasiswa'];
        $nama_mahasiswa = $_POST['nama_mahasiswa'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $id_jurusan = $_POST['id_jurusan'];

        $edit = mysqli_query($toll, "UPDATE data_mahasiswa
        SET nim_mhs = '$nim_mahasiswa', nama_mhs = '$nama_mahasiswa', tgl_lahir = '$tgl_lahir', jenis_kelamin = '$jenis_kelamin', id_jurusan = '$id_jurusan'
        where id_mhs = '$id'");

        if (!$edit) {
            echo '<script>
            alert("Gagal menyimpan data santri.");
            window.location.href="data_mahasiswa.php";
            </script>';
            exit;
        } else {
            echo '<script>
            alert("Data santri berhasil disimpan.");
            window.location.href="data_mahasiswa.php";
          </script>';
            exit;
        }
    }
}

mysqli_close($toll);

?>

<?php if (!empty($nimValue)) : ?>
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        <strong>Data Gagal Disimpan! </strong> NIM <strong><?= $nimValue ?> </strong>Sudah digunakan.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif ?>

<?php include 'layout/footer.php' ?>