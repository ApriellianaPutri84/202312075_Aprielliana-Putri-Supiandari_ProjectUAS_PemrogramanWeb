<?php
session_start();
include('../../config/koneksi.php');
include('../../auth/cek_login.php');

if (isset($_POST['simpan'])) {
  $nama = $_POST['nama'];
  $plat = $_POST['no_plat'];
  $status = $_POST['status'];

  mysqli_query($conn, "INSERT INTO mobil (nama, no_plat, status) VALUES ('$nama','$plat','$status')");
  header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Tambah Mobil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h4>Tambah Mobil</h4>
  <form method="POST">
    <div class="mb-3">
      <label>Nama Mobil</label>
      <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Nomor Plat</label>
      <input type="text" name="no_plat" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Status</label>
      <select name="status" class="form-control">
        <option value="Tersedia">Tersedia</option>
        <option value="Disewa">Disewa</option>
        <option value="Servis">Servis</option>
      </select>
    </div>
    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>
</body>
</html>
