<?php
session_start();
include('../../config/koneksi.php');
include('../../auth/cek_login.php');

$mobil = mysqli_query($conn, "SELECT * FROM mobil");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Data Mobil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #e3f2fd, #ffffff);
      font-family: 'Segoe UI', sans-serif;
    }
    .card {
      border-radius: 16px;
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.05);
    }
    .card-header {
      background-color: #0d6efd;
      color: white;
      border-top-left-radius: 16px;
      border-top-right-radius: 16px;
    }
    .btn-primary, .btn-warning, .btn-danger {
      border-radius: 20px;
    }
    .table th {
      background-color: #f8f9fa;
      text-align: center;
    }
    .table td {
      vertical-align: middle;
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <div class="card">
    <div class="card-header text-center">
      <h4 class="mb-0">🚘 Data Mobil</h4>
    </div>
    <div class="card-body">
      
      <a href="tambah.php" class="btn btn-primary mb-3">+ Tambah Mobil</a>

      <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Mobil</th>
              <th>No Plat</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no=1; foreach ($mobil as $m): ?>
            <tr>
              <td class="text-center"><?= $no++ ?></td>
              <td><?= $m['nama'] ?></td>
              <td><?= $m['no_plat'] ?></td>
              <td>
                <span class="badge bg-<?= $m['status'] === 'Tersedia' ? 'success' : 'secondary' ?>">
                  <?= $m['status'] ?>
                </span>
              </td>
              <td class="text-center">
                <a href="edit.php?id=<?= $m['id'] ?>" class="btn btn-warning btn-sm me-1">Edit</a>
                <a href="hapus.php?id=<?= $m['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
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
