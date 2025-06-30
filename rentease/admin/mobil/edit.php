<?php
session_start();
include('../../config/koneksi.php');
include('../../auth/cek_login.php');

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM mobil WHERE id=$id"));

if (isset($_POST['update'])) {
  $nama = $_POST['nama'];
  $plat = $_POST['no_plat'];
  $status = $_POST['status'];
  mysqli_query($conn, "UPDATE mobil SET nama='$nama', no_plat='$plat', status='$status' WHERE id=$id");
  header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Mobil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h4>Edit Mobil</h4>
  <form method="POST">
    <div class="mb-3">
      <label>Nama Mobil</label>
      <input type="text" name="nama" value="<?= $data['nama'] ?>" class="form-control">
    </div>
    <div class="mb-3">
      <label>Nomor Plat</label>
      <input type="text" name="no_plat" value="<?= $data['no_plat'] ?>" class="form-control">
    </div>
    <div class="mb-3">
      <label>Status</label>
      <select name="status" class="form-control">
        <option value="Tersedia" <?= $data['status']=='Tersedia'?'selected':'' ?>>Tersedia</option>
        <option value="Disewa" <?= $data['status']=='Disewa'?'selected':'' ?>>Disewa</option>
        <option value="Servis" <?= $data['status']=='Servis'?'selected':'' ?>>Servis</option>
      </select>
    </div>
    <button type="submit" name="update" class="btn btn-primary">Update</button>
    <a href="index.php" class="btn btn-secondary">Batal</a>
  </form>
</div>
</body>
</html>
