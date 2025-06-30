<?php
session_start();
include('../../config/koneksi.php');
include('../../auth/cek_login.php');

// Ambil data sewa
$sewa = mysqli_query($conn, "
  SELECT sewa.*, pelanggan.nama AS pelanggan, mobil.nama AS mobil 
  FROM sewa 
  JOIN pelanggan ON sewa.pelanggan_id = pelanggan.id 
  JOIN mobil ON sewa.mobil_id = mobil.id
  ORDER BY sewa.id DESC
");

// Proses simpan
if (isset($_POST['simpan'])) {
  $sewa_id = $_POST['sewa_id'];
  $tanggal = $_POST['tanggal'];
  $jumlah = $_POST['jumlah'];
  $metode = $_POST['metode'];
  $keterangan = $_POST['keterangan'];

  mysqli_query($conn, "INSERT INTO pembayaran (sewa_id, tanggal, jumlah, metode, keterangan)
    VALUES ('$sewa_id', '$tanggal', '$jumlah', '$metode', '$keterangan')");

  header('Location: index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Tambah Pembayaran</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h4>Tambah Data Pembayaran</h4>
  <form method="POST">
    <div class="mb-3">
      <label>Sewa</label>
      <select name="sewa_id" class="form-control" required>
        <option value="">-- Pilih --</option>
        <?php foreach ($sewa as $s): ?>
        <option value="<?= $s['id'] ?>">
          <?= $s['pelanggan'] ?> - <?= $s['mobil'] ?> (<?= $s['tgl_sewa'] ?>)
        </option>
        <?php endforeach ?>
      </select>
    </div>

    <div class="mb-3">
      <label>Tanggal</label>
      <input type="date" name="tanggal" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Jumlah</label>
      <input type="number" name="jumlah" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Metode Pembayaran</label>
      <select name="metode" class="form-control" required>
        <option value="Cash">Cash</option>
        <option value="Transfer Bank">Transfer Bank</option>
      </select>
    </div>

    <div class="mb-3">
      <label>Keterangan</label>
      <input type="text" name="keterangan" class="form-control">
    </div>

    <button class="btn btn-success" name="simpan">Simpan</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>
</body>
</html>
