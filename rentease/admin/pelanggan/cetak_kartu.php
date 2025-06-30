<?php
session_start();
include('../../config/koneksi.php');
include('../../auth/cek_login.php');

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id=$id");
$p = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Kartu Member</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f0f8ff;
      padding: 40px;
    }

    .kartu {
      width: 420px;
      background: linear-gradient(to right, #2196f3, #64b5f6);
      color: white;
      padding: 30px;
      border-radius: 16px;
      margin: auto;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
      border: 1px solid #1976d2;
      -webkit-print-color-adjust: exact;
      print-color-adjust: exact;
    }

    .kartu h2 {
      text-align: center;
      margin-bottom: 20px;
      font-size: 24px;
      letter-spacing: 1px;
    }

    .info {
      font-size: 16px;
      line-height: 1.8;
    }

    .info label {
      font-weight: 600;
      display: inline-block;
      width: 120px;
    }

    .footer {
      text-align: right;
      font-size: 13px;
      margin-top: 30px;
      color: #e3f2fd;
    }

    @page {
      size: A5 landscape;
      margin: 10mm;
    }

    @media print {
      body {
        padding: 0;
        background: none;
      }
      .kartu {
        box-shadow: none;
        border: 1px solid #000;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
        background: linear-gradient(to right, #2196f3, #64b5f6) !important;
        color: white !important;
      }
      .footer {
        color: #fff !important;
      }
    }
  </style>
</head>
<body onload="window.print()">

  <div class="kartu">
    <h2>💳 Kartu Member RentEase</h2>

    <div class="info">
      <p><label>Nama:</label> <?= $p['nama'] ?></p>
      <p><label>No HP:</label> <?= $p['no_hp'] ?></p>
      <p><label>Alamat:</label> <?= $p['alamat'] ?></p>
      <p><label>ID Member:</label> <?= $p['id'] ?></p>
    </div>

    <div class="footer">
      Dicetak: <?= date('d-m-Y') ?><br>
      <em>RentEase Membership System</em>
    </div>
  </div>

</body>
</html>
