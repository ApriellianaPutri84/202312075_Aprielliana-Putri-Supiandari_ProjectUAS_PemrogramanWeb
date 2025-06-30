<?php
session_start();
include('../../config/koneksi.php');
include('../../auth/cek_login.php');

$id = $_GET['id'];
$query = mysqli_query($conn, "
  SELECT sewa.*, pelanggan.nama AS pelanggan, pelanggan.no_hp, pelanggan.alamat, 
         mobil.nama AS mobil, mobil.no_plat 
  FROM sewa
  JOIN pelanggan ON sewa.pelanggan_id = pelanggan.id
  JOIN mobil ON sewa.mobil_id = mobil.id
  WHERE sewa.id = $id
");

$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Struk Penyewaan Mobil</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #e0f7fa, #ffffff);
      padding: 30px;
    }

    .receipt {
  max-width: 500px;
  margin: auto;
  background: 	#e3f2fd; /* ganti dari putih menjadi biru muda */
  border-radius: 12px;
  padding: 30px;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
  border: 1px solid #90caf9; /* biru terang */
}

    .receipt h2 {
      text-align: center;
      color: #0d6efd;
      margin-bottom: 8px;
    }

    .receipt h5 {
      text-align: center;
      font-weight: 500;
      color: #444;
      margin-bottom: 25px;
    }

    .info {
      font-size: 15px;
      line-height: 1.7;
    }

    .info label {
      font-weight: 600;
      color: #333;
      display: inline-block;
      width: 160px;
    }

    .divider {
      border-top: 1px dashed #ccc;
      margin: 20px 0;
    }

    .footer {
      text-align: right;
      font-size: 13px;
      color: #555;
      margin-top: 40px;
    }

    .badge-status {
      display: inline-block;
      padding: 4px 10px;
      font-size: 13px;
      border-radius: 8px;
      color: #fff;
    }

    .badge-success {
      background-color: #28a745;
    }

    .badge-warning {
      background-color: #ffc107;
      color: #000;
    }

    @media print {
      body {
        background: white;
        padding: 0;
      }
      .receipt {
        box-shadow: none;
        border: none;
      }
    }
  </style>
</head>
<body onload="window.print()">

  <div class="receipt">
    <h2>🚗 RentEase</h2>
    <h5>Struk Penyewaan Mobil</h5>

    <div class="info">
      <label>👤 Nama Pelanggan:</label> <?= $data['pelanggan'] ?><br>
      <label>📞 No HP:</label> <?= $data['no_hp'] ?><br>
      <label>🏠 Alamat:</label> <?= $data['alamat'] ?>
    </div>

    <div class="divider"></div>

    <div class="info">
      <label>🚘 Mobil:</label> <?= $data['mobil'] ?> (<?= $data['no_plat'] ?>)<br>
      <label>📅 Tanggal Sewa:</label> <?= $data['tgl_sewa'] ?><br>
      <label>📅 Tanggal Kembali:</label> <?= $data['tgl_kembali'] ?><br>
      <label>💰 Harga Sewa:</label> Rp<?= number_format($data['harga'], 0, ',', '.') ?><br>
      <label>🧾 Status:</label> 
      <span class="badge-status <?= $data['status'] === 'Selesai' ? 'badge-success' : 'badge-warning' ?>">
        <?= $data['status'] ?>
      </span>
    </div>

    <div class="footer">
      📄 Tanggal Cetak: <?= date('d-m-Y') ?><br>
      <strong>Admin RentEase</strong>
    </div>
  </div>

</body>
</html>
