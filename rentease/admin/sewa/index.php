<?php
session_start();
include('../../config/koneksi.php');
include('../../auth/cek_login.php');

// Ambil semua data sewa + join pelanggan dan mobil
$query = mysqli_query($conn, "
  SELECT sewa.*, 
         pelanggan.nama AS pelanggan, 
         mobil.nama AS mobil 
  FROM sewa 
  JOIN pelanggan ON sewa.pelanggan_id = pelanggan.id 
  JOIN mobil ON sewa.mobil_id = mobil.id 
  ORDER BY sewa.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Data Sewa Mobil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #f0f8ff, #ffffff);
      font-family: 'Segoe UI', sans-serif;
    }
    .container {
      max-width: 1000px;
    }
    .card {
      border-radius: 16px;
      box-shadow: 0 6px 12px rgba(0,0,0,0.05);
    }
    .card-header {
      background-color: #0d6efd;
      color: white;
      border-radius: 16px 16px 0 0;
    }
    .btn-primary {
      border-radius: 25px;
    }
    table thead {
      background-color: #f1f9ff;
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <div class="card">
    <div class="card-header text-center">
      <h4 class="mb-0">🚗 Data Sewa Mobil</h4>
    </div>
    <div class="card-body">

      <a href="tambah.php" class="btn btn-primary mb-3">+ Sewa Mobil</a>

      <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
          <thead class="text-center">
            <tr>
              <th>No</th>
              <th>Pelanggan</th>
              <th>Mobil</th>
              <th>Tgl Sewa</th>
              <th>Tgl Kembali</th>
              <th>Harga</th>
              <th>Status</th>
              <th>Aksi</th> <!-- Tambahan kolom aksi -->
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; foreach ($query as $d): ?>
            <tr>
              <td class="text-center"><?= $no++ ?></td>
              <td><?= $d['pelanggan'] ?></td>
              <td><?= $d['mobil'] ?></td>
              <td><?= $d['tgl_sewa'] ?></td>
              <td><?= $d['tgl_kembali'] ?></td>
              <td>Rp<?= isset($d['harga']) ? number_format($d['harga']) : '0' ?></td>
              <td>
                <span class="badge bg-<?= $d['status'] === 'Selesai' ? 'success' : 'warning' ?>">
                  <?= isset($d['status']) ? $d['status'] : '-' ?>
                </span>
              </td>
              <td class="text-center">
                <a href="cetak_struk.php?id=<?= $d['id'] ?>" target="_blank" class="btn btn-info btn-sm">Cetak</a>
              </td>
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
