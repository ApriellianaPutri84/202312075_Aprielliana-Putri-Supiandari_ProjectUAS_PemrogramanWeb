<?php
session_start();
include('../../config/koneksi.php');
include('../../auth/cek_login.php');

if (isset($_POST['simpan'])) {
  $nama = $_POST['nama'];
  $hp = $_POST['no_hp'];
  $alamat = $_POST['alamat'];

  mysqli_query($conn, "INSERT INTO pelanggan (nama, no_hp, alamat) VALUES ('$nama','$hp','$alamat')");
  header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Tambah Pelanggan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h4>Tambah Pelanggan</h4>
  <form method="POST">
    <div class="mb-3">
      <label>Nama</label>
      <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>No HP</label>
      <input type="text" name="no_hp" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Alamat</label>
      <textarea name="alamat" class="form-control" required></textarea>
    </div>
    <button class="btn btn-primary" name="simpan">Simpan</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>
</body>
</html>
