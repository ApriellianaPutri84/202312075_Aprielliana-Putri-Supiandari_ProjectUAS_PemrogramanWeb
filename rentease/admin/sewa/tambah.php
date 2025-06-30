<?php
session_start();
include('../../config/koneksi.php');
include('../../auth/cek_login.php');

$mobil = mysqli_query($conn, "SELECT * FROM mobil WHERE status='Tersedia'");

if (isset($_POST['simpan'])) {
  $nama_pelanggan = $_POST['nama_pelanggan'];
  $no_hp = $_POST['no_hp'];
  $mobil_id = $_POST['mobil_id'];
  $tgl_sewa = $_POST['tgl_sewa'];
  $tgl_kembali = $_POST['tgl_kembali'];
  $harga = $_POST['harga'];
  
  // Cek apakah pelanggan sudah ada berdasarkan nama dan no_hp
  $cek = mysqli_query($conn, "SELECT * FROM pelanggan WHERE nama='$nama_pelanggan' AND no_hp='$no_hp'");
  if (mysqli_num_rows($cek) > 0) {
    $data = mysqli_fetch_assoc($cek);
    $pelanggan_id = $data['id'];
  } else {
    // Tambahkan pelanggan baru
    mysqli_query($conn, "INSERT INTO pelanggan(nama, no_hp) VALUES('$nama_pelanggan', '$no_hp')");
    $pelanggan_id = mysqli_insert_id($conn);
  }

  // Simpan data ke tabel sewa
  mysqli_query($conn, "INSERT INTO sewa (pelanggan_id, mobil_id, tgl_sewa, tgl_kembali, harga) 
    VALUES ('$pelanggan_id','$mobil_id','$tgl_sewa','$tgl_kembali','$harga')");

  // Ambil ID sewa terakhir yang baru dimasukkan
  $_SESSION['sewa_terakhir'] = mysqli_insert_id($conn);

  // Update status mobil
  mysqli_query($conn, "UPDATE mobil SET status='Disewa' WHERE id=$mobil_id");

  // Arahkan ke halaman pembayaran
  header("Location: ../pembayaran/tambah.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Sewa Mobil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h4>Sewa Mobil</h4>
  <form method="POST">
    <div class="mb-3">
      <label>Nama Pelanggan</label>
      <input type="text" name="nama_pelanggan" class="form-control" placeholder="Masukkan nama pelanggan" required>
    </div>
    <div class="mb-3">
      <label>No HP</label>
      <input type="text" name="no_hp" class="form-control" placeholder="08xxxxxxxxxx" required>
    </div>
    <div class="mb-3">
      <label>Mobil</label>
      <select name="mobil_id" class="form-control" required>
        <option value="">-- Pilih Mobil --</option>
        <?php foreach ($mobil as $m): ?>
          <option value="<?= $m['id'] ?>"><?= $m['nama'] ?> (<?= $m['no_plat'] ?>)</option>
        <?php endforeach ?>
      </select>
    </div>
    <div class="mb-3">
      <label>Tanggal Sewa</label>
      <input type="date" name="tgl_sewa" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Tanggal Kembali</label>
      <input type="date" name="tgl_kembali" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Harga Sewa</label>
      <input type="number" name="harga" class="form-control" required>
    </div>
    <button class="btn btn-primary" name="simpan">Simpan</button>
    <a href="index.php" class="btn btn-secondary">Batal</a>
  </form>
</div>
</body>
</html>
