<?php

include 'layout/header.php';
include 'koneksi.php';

$query = mysqli_query($toll, "SELECT * FROM data_operator");

?>

<div class="card">
    <div class="card-header">
        List Operator
    </div>
    <div class="card-body">
        <a href="tambah_operator.php" class="btn btn-primary btn-sm mb-3">+ Tambah Data Operator</a>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($query as $get) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $get['nama_operator'] ?></td>
                            <td><?= $get['email_operator'] ?></td>
                            <td><?= $get['password_operator'] ?></td>
                            <td>
                                <a href="edit_operator.php?id=<?= $get['id_operator'] ?>" class="badge bg-primary">
                                    Edit
                                </a>
                                <a onclick="return confirm('Hapus Data?')" href="hapus_operator.php?id=<?= $get['id_operator'] ?>" class="badge bg-danger">
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