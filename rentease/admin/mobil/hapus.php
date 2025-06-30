<?php
session_start();
include('../../config/koneksi.php');
include('../../auth/cek_login.php');

$id = $_GET['id'];

// Cek apakah mobil sedang digunakan di transaksi sewa
$cek = mysqli_query($conn, "SELECT * FROM sewa WHERE mobil_id = $id");

if (mysqli_num_rows($cek) > 0) {
    echo "<script>
        alert('Gagal menghapus! Mobil masih digunakan dalam transaksi sewa.');
        window.location.href = 'index.php';
    </script>";
    exit;
}

// Aman, hapus mobil
mysqli_query($conn, "DELETE FROM mobil WHERE id = $id") or die(mysqli_error($conn));
header("Location: index.php");
?>