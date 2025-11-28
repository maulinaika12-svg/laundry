<?php
    $koneksi = mysqli_connect ("localhost","root","","db_laundry");

    if(mysqli_connect_errno()) {
        echo "koneksi database gagal : ". mysqli_connect_errno();
    }
?>