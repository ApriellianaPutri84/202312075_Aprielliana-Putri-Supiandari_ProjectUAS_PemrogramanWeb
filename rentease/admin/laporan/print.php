<?php
session_start();
include('../../config/koneksi.php');
include('../../auth/cek_login.php');

// Ambil filter tanggal dari POST
$dari = $_POST['dari'] ?? '';
$sampai = $_POST['sampai'] ?? '';
$filter = "";

if ($dari && $sampai) {
  $filter = "WHERE tgl_sewa BETWEEN '$dari' AND '$sampai'";
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
  <title>Cetak Struk Laporan Sewa Mobil</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 30px; }
    h2 { text-align: center; margin-bottom: 0; }
    p { text-align: center; margin-top: 5px; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #000; padding: 8px; font-size: 14px; }
    .text-right { text-align: right; }
  </style>
</head>
<body onload="window.print()">

  <h2>RentEase</h2>
  <p><strong>Struk Laporan Transaksi Sewa Mobil</strong></p>

  <?php if ($dari && $sampai): ?>
    <p><strong>Periode:</strong> <?= $dari ?> s.d <?= $sampai ?></p>
  <?php endif; ?>

  <table>
    <thead>
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
          $status = isset($row['status']) ? $row['status'] : '-';
          $total += $harga;
      ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $row['tgl_sewa'] ?></td>
        <td><?= $row['pelanggan'] ?></td>
        <td><?= $row['mobil'] ?></td>
        <td>Rp<?= number_format($harga) ?></td>
        <td><?= $status ?></td>
      </tr>
      <?php endforeach ?>
      <tr>
        <td colspan="4" class="text-right"><strong>Total</strong></td>
        <td colspan="2"><strong>Rp<?= number_format($total) ?></strong></td>
      </tr>
    </tbody>
  </table>

  <br><br>
  <p style="text-align: right; margin-top: 50px;">
    <?= date('d-m-Y') ?><br>
    <strong>Admin RentEase</strong>
  </p>

</body>
</html>
