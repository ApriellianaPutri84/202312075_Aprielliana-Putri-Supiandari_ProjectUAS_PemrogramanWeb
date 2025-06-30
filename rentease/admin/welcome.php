<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Selamat Datang - RentEase</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #e3f2fd, #ffffff);
      font-family: 'Segoe UI', sans-serif;
    }
    .welcome-card {
      max-width: 600px;
      margin: 5rem auto;
      padding: 2rem;
      border-radius: 20px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      background: white;
      text-align: center;
      animation: fadeIn 0.8s ease-in-out;
    }
    .welcome-icon {
      font-size: 3.5rem;
      color: #0d6efd;
      margin-bottom: 1rem;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>

<div class="welcome-card">
  <div class="welcome-icon"><i class="bi bi-emoji-smile"></i></div>
  <h2 class="fw-semibold">Selamat Datang, <?= $_SESSION['username'] ?>! 👋</h2>
  <p class="text-muted mt-3">Gunakan menu navigasi di sebelah kiri untuk mengelola <strong>data mobil, pelanggan, transaksi, laporan</strong>, dan lainnya dalam sistem <span class="text-primary fw-bold">RentEase</span>.</p>
</div>

</body>
</html>
