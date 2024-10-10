<?php

include 'layout/header.php';
include 'koneksi.php';

$option2 = mysqli_query($toll, "SELECT * FROM data_jurusan");

?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="data_mahasiswa.php">Data Mahasiswa</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Mahasiswa</li>
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
                <input type="text" class="form-control" name="nim_mahasiswa" placeholder="Masukkan nomor induk mahasiswa...">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-3">
                <label for="">Nama Mahasiswa</label>
            </div>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="nama_mahasiswa" placeholder="Masukkan nama lengkap mahasiswa...">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-3">
                <label for="">Tanggal Lahir</label>
            </div>
            <div class="col-lg-9">
                <input type="date" class="form-control" name="tgl_lahir">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-3">
                <label for="">Jenis Kelamin</label>
            </div>
            <div class="col-lg-9">
                <select class="form-select" name="jenis_kelamin" aria-label="Default select example">
                    <option selected disabled>Pilih Jenis Kelamin...</option>
                    <option value="laki-laki">Laki-Laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-3">
                <label for="">Jurusan</label>
            </div>
            <div class="col-lg-9">
                <select class="form-select" name="id_jurusan">
                    <option selected disabled>Pilih Jurusan...</option>
                    <?php 
                    foreach ($option2 as $get) : ?>
                        <option value="<?= $get['id_jurusan'] ?>"><?= $get['nama_jurusan'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button name="simpan" class="btn btn-success">Simpan Data</button>
        <a href="data_mahasiswa.php" class="btn btn-danger">Kembali</a>
    </div>
</form>

<?php

include 'koneksi.php';

$nimValue = '';

if (isset($_POST['simpan'])) {
    $nim = $_POST['nim_mahasiswa'];

    $cekNIM = mysqli_query($toll, "SELECT * FROM data_mahasiswa WHERE nim_mhs = '$nim'");
    if (mysqli_num_rows($cekNIM) > 0) {
        $nimValue = $nim;
    } else {
        $nim_mahasiswa = $_POST['nim_mahasiswa'];
        $nama_mahasiswa = $_POST['nama_mahasiswa'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $id_jurusan = $_POST['id_jurusan'];

        $simpan = mysqli_query($toll, "INSERT INTO data_mahasiswa
        values(null, '$nim_mahasiswa', '$nama_mahasiswa', '$tgl_lahir', '$id_jurusan', '$jenis_kelamin')");

        if (!$simpan) {
            echo '<script>
            alert("Gagal menyimpan data mahasiswa.");
            window.location.href="data_mahasiswa.php";
            </script>';
            exit;
        } else {
            echo '<script>
            alert("Data mahasiswa berhasil disimpan.");
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