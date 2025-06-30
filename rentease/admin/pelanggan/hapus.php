<?php
session_start();
include('../../config/koneksi.php');
include('../../auth/cek_login.php');

$id = $_GET['id'];

// Cek apakah mobil digunakan dalam transaksi sewa
$cek = mysqli_query($conn, "SELECT * FROM sewa WHERE mobil_id=$id");
if (mysqli_num_rows($cek) > 0) {
  echo "<script>alert('Mobil tidak bisa dihapus karena masih digunakan dalam transaksi sewa.'); window.location='index.php';</script>";
  exit;
}

// Jika aman, baru hapus
mysqli_query($conn, "DELETE FROM mobil WHERE id=$id");
header("Location: index.php");
?>
