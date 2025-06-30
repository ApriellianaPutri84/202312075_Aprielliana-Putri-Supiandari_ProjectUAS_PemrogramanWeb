<?php
session_start();
include('../../config/koneksi.php');
include('../../auth/cek_login.php');

// Filter tanggal jika ada
$filter = "";
if (isset($_POST['filter'])) {
  $dari = $_POST['dari'];
  $sampai = $_POST['sampai'];
  $filter = "WHERE tgl_sewa BETWEEN '$dari' AND '$sampai'";
} else {
  $dari = $sampai = "";
}

$query = mysqli_query($conn, "
  SELECT sewa.*, pelanggan.nama AS pelanggan, mobil.nama AS mobil 
  FROM sewa 
  JOIN pelanggan ON sewa.pelanggan_id = pelanggan.id 
  JOIN mobil ON sewa.mobil_id = mobil.id
  $filter
  ORDER BY sewa.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <title>Laporan Transaksi Sewa</title>
  <meta charset="UTF-8">
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
      border-top-left-radius: 16px;
      border-top-right-radius: 16px;
    }
    .btn-primary, .btn-success {
      border-radius: 30px;
    }
    table th {
      background-color: #f1f9ff;
    }
  </style>
</head>
<body>

<div class="container mt-5 mb-5">
  <div class="card">
    <div class="card-header text-center">
      <h4 class="mb-0">📊Laporan Transaksi Sewa Mobil</h4>
    </div>
    <div class="card-body">

      <!-- Form Filter -->
      <form method="POST" class="row g-2 mb-4">
        <div class="col-md-4">
          <label>Dari Tanggal:</label>
          <input type="date" name="dari" class="form-control" value="<?= $dari ?>" required>
        </div>
        <div class="col-md-4">
          <label>Sampai Tanggal:</label>
          <input type="date" name="sampai" class="form-control" value="<?= $sampai ?>" required>
        </div>
        <div class="col-md-4 d-flex align-items-end">
          <button class="btn btn-primary me-2" name="filter">🔎Filter</button>
        </div>
      </form>

      <!-- Tombol Cetak -->
      <form action="print.php" method="POST" target="_blank" class="mb-4">
        <input type="hidden" name="dari" value="<?= $dari ?>">
        <input type="hidden" name="sampai" value="<?= $sampai ?>">
        <button class="btn btn-success">🖨️ Cetak Struk</button>
      </form>

      <!-- Tabel Laporan -->
      <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
          <thead class="table-light text-center">
            <tr>
              <th>No</th>
              <th>Tanggal Sewa</th>
              <th>Pelanggan</th>
              <th>Mobil</th>
              <th>Harga</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $no = 1; 
              $total = 0;
              foreach ($query as $row): 
                $harga = isset($row['harga']) ? $row['harga'] : 0;
                $total += $harga;
            ?>
            <tr>
              <td class="text-center"><?= $no++ ?></td>
              <td><?= $row['tgl_sewa'] ?></td>
              <td><?= $row['pelanggan'] ?></td>
              <td><?= $row['mobil'] ?></td>
              <td>Rp<?= number_format($harga) ?></td>
              <td>
                <span class="badge bg-<?= $row['status'] === 'Selesai' ? 'success' : 'warning' ?>">
                  <?= $row['status'] ?>
                </span>
              </td>
            </tr>
            <?php endforeach ?>
            <tr class="fw-bold text-end">
              <td colspan="4"></td>
              <td colspan="2"><strong>Rp<?= number_format($total) ?></strong></td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Grafik Jumlah Sewa per Mobil -->
<h5 class="mt-5 mb-3">📈 Grafik Jumlah Sewa per Mobil</h5>
<canvas id="chartMobil" height="100"></canvas>

<?php
// Ambil data jumlah sewa per mobil untuk grafik
$grafik = mysqli_query($conn, "
  SELECT mobil.nama AS mobil, COUNT(sewa.id) AS total
  FROM sewa 
  JOIN mobil ON sewa.mobil_id = mobil.id
  $filter
  GROUP BY mobil.nama
");

// Persiapkan data untuk Chart.js
$labels = [];
$data = [];
foreach ($grafik as $g) {
  $labels[] = $g['mobil'];
  $data[] = $g['total'];
}
?>

<script>
const ctx = document.getElementById('chartMobil').getContext('2d');
const chartMobil = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: <?= json_encode($labels) ?>,
    datasets: [{
      label: 'Jumlah Sewa',
      data: <?= json_encode($data) ?>,
      backgroundColor: '#0d6efd',
      borderRadius: 6
    }]
  },
  options: {
    responsive: true,
    scales: {
      y: {
        beginAtZero: true,
        ticks: {
          precision: 0
        }
      }
    }
  }
});
</script>


    </div>
  </div>
</div>

</body>
</html>
