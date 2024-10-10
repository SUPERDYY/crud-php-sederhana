<?php

include 'koneksi.php';

$id = $_GET['id'];

$hapus = mysqli_query($toll, "DELETE FROM data_operator where id_operator = '$id'");

if ($hapus) {
    echo '<script>
    alert("data berhasil dihapus");
    window.location.href="data_operator.php";
    </script>';
}