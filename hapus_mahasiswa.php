<?php

include 'koneksi.php';

$id = $_GET['id'];

$hapus = mysqli_query($toll, "DELETE FROM data_mahasiswa where id_mhs = '$id'");

if ($hapus) {
    echo '<script>
    alert("data berhasil dihapus");
    window.location.href="data_mahasiswa.php";
    </script>';
}