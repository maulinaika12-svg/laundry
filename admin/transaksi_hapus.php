<?php

include '../koneksi.php';

$id = $_GET['id'];

mysqli_query($koneksi,"delete from transaksi where transaksi_id='$id'");

mysqli_query($koneksi,"delete from pakaian where pakaian_id='$id'");

 echo "<script>alert('Data akan dihapus?'); window.location.href='transaksi.php'</script>";
?>