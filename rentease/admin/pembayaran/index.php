<?php
session_start();
include('../../config/koneksi.php');
include('../../auth/cek_login.php');

$pembayaran = mysqli_query($conn, "
  SELECT pembayaran.*, sewa.tgl_sewa, pelanggan.nama AS pelanggan, mobil.nama AS mobil
  FROM pembayaran 
  JOIN sewa ON pembayaran.sewa_id = sewa.id
  JOIN pelanggan ON sewa.pelanggan_id = pelanggan.id
  JOIN mobil ON sewa.mobil_id = mobil.id
  ORDER BY pembayaran.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Data Pembayaran</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #e3f2fd, #ffffff);
      font-family: 'Segoe UI', sans-serif;
    }
    .card {
      border-radius: 16px;
      box-shadow: 0 6px 12px rgba(0,0,0,0.05);
    }
    .card-header {
      background-color: #0d6efd;
      color: white;
      border-radius: 16px 16px 0 0;
      text-align: center;
    }
    .btn-primary {
      border-radius: 20px;
    }
    .table th {
      background-color: #f8f9fa;
      text-align: center;
    }
    .table-hover tbody tr:hover {
      background-color: #f1f1f1;
    }
    .table td {
      vertical-align: middle;
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <div class="card">
    <div class="card-header">
      <h4 class="mb-0">💳 Data Pembayaran Sewa Mobil</h4>
    </div>
    <div class="card-body">

      <a href="tambah.php" class="btn btn-primary mb-3">+ Tambah Pembayaran</a>

      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle">
          <thead>
            <tr>
              <th>No</th>
              <th>Tanggal</th>
              <th>Pelanggan</th>
              <th>Mobil</th>
              <th>Jumlah</th>
              <th>Metode</th>
              <th>Keterangan</th>
            </tr>
          </thead>
          <tbody>
            <?php $no=1; foreach ($pembayaran as $p): ?>
            <tr>
              <td class="text-center"><?= $no++ ?></td>
              <td><?= $p['tanggal'] ?></td>
              <td><?= $p['pelanggan'] ?></td>
              <td><?= $p['mobil'] ?></td>
              <td>Rp<?= number_format($p['jumlah']) ?></td>
              <td><?= $p['metode'] ?></td>
              <td><?= $p['keterangan'] ?></td>
            </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

</body>
</html>
