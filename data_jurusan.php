<?php

include 'layout/header.php';
include 'koneksi.php';

$query = mysqli_query($toll, "SELECT * FROM data_jurusan");

?>

<div class="card">
    <div class="card-header">
        List Jurusan
    </div>
    <div class="card-body">
        <a href="tambah_jurusan.php" class="btn btn-primary btn-sm mb-3">+ Tambah Data Jurusan</a>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Jurusan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($query as $get) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $get['nama_jurusan'] ?></td>
                            <td>
                                <a href="edit_jurusan.php?id=<?= $get['id_jurusan'] ?>" class="badge bg-primary">
                                    Edit
                                </a>
                                <a onclick="return confirm('Hapus Data?')" href="hapus_jurusan.php?id=<?= $get['id_jurusan'] ?>" class="badge bg-danger">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'layout/footer.php' ?>