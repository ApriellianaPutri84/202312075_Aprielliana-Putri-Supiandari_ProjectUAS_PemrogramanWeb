<?php
session_start();
include('../../config/koneksi.php');
include('../../auth/cek_login.php');

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM pelanggan WHERE id=$id"));

if (isset($_POST['update'])) {
  $nama = $_POST['nama'];
  $hp = $_POST['no_hp'];
  $alamat = $_POST['alamat'];
  mysqli_query($conn, "UPDATE pelanggan SET nama='$nama', no_hp='$hp', alamat='$alamat' WHERE id=$id");
  header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Pelanggan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h4>Edit Pelanggan</h4>
  <form method="POST">
    <div class="mb-3">
      <label>Nama</label>
      <input type="text" name="nama" value="<?= $data['nama'] ?>" class="form-control">
    </div>
    <div class="mb-3">
      <label>No HP</label>
      <input type="text" name="no_hp" value="<?= $data['no_hp'] ?>" class="form-control">
    </div>
    <div class="mb-3">
      <label>Alamat</label>
      <textarea name="alamat" class="form-control"><?= $data['alamat'] ?></textarea>
    </div>
    <button class="btn btn-primary" name="update">Update</button>
    <a href="index.php" class="btn btn-secondary">Batal</a>
  </form>
</div>
</body>
</html>
