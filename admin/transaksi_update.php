<?php
include '../koneksi.php';

// Ambil data dari form
$id = $_POST['id'];
$pelanggan = $_POST['pelanggan'];
$berat = $_POST['berat'];
$tgl_selesai = $_POST['tgl_selesai'];
$status = $_POST['status'];

// Ambil harga per kilo dari tabel harga
$h = mysqli_query($koneksi, "SELECT harga_per_kilo FROM harga LIMIT 1");
$harga_data = mysqli_fetch_assoc($h);
$harga = $berat * $harga_data['harga_per_kilo'];

// Update tabel transaksi
mysqli_query($koneksi, "UPDATE transaksi SET 
    transaksi_pelanggan='$pelanggan',
    transaksi_harga='$harga',
    transaksi_berat='$berat',
    transaksi_tgl_selesai='$tgl_selesai',
    transaksi_status='$status'
    WHERE transaksi_id='$id'
");

// Hapus pakaian lama untuk transaksi ini
mysqli_query($koneksi, "DELETE FROM pakaian WHERE pakaian_transaksi='$id'");

// Ambil data pakaian dari form
$jenis_pakaian = $_POST['jenis_pakaian'];
$jumlah_pakaian = $_POST['jumlah_pakaian'];

// Insert pakaian baru
for($x=0; $x<count($jenis_pakaian); $x++){
    if(trim($jenis_pakaian[$x]) != "" && $jumlah_pakaian[$x] != ""){
        mysqli_query($koneksi, "INSERT INTO pakaian VALUES (
            '', '$id', '{$jenis_pakaian[$x]}', '{$jumlah_pakaian[$x]}'
        )");
    }
}

// Redirect ke halaman transaksi
header("location:transaksi.php");
exit;
?>
