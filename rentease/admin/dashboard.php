<?php
session_start();
include('../auth/cek_login.php');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Dashboard - RentEase</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #f7faff;
    }

    #wrapper {
      display: flex;
    }

    #sidebar {
      background: linear-gradient(180deg, #d0e9ff, #ffffff);
      color: #003366;
      width: 250px;
      min-height: 100vh;
      padding: 20px;
      transition: all 0.3s ease-in-out;
      box-shadow: 4px 0 12px rgba(0, 0, 0, 0.05);
    }

    #sidebar .nav-link {
      color: #003366;
      font-weight: 500;
      padding: 10px 15px;
      border-radius: 10px;
      transition: all 0.3s ease;
    }

    #sidebar .nav-link:hover {
      background-color: rgba(0, 51, 102, 0.1);
      transform: translateX(5px);
    }

    #sidebar .btn-outline-light {
      color: #003366;
      border-color: #003366;
      transition: all 0.3s ease;
      border-radius: 25px;
    }

    #sidebar .btn-outline-light:hover {
      background-color: #003366;
      color: #ffffff;
    }

    #mainContent {
      flex-grow: 1;
      border: none;
      height: calc(100vh - 56px);
      width: 100%;
    }

    .navbar {
      height: 56px;
      background: #ffffff;
      box-shadow: 0 2px 4px rgba(0,0,0,0.06);
    }

    @media (max-width: 768px) {
      #sidebar {
        margin-left: -250px;
      }
    }
  </style>
</head>
<body>

<div class="d-flex" id="wrapper">
  <!-- Sidebar -->
  <div id="sidebar">
    <div class="d-flex align-items-center mb-4">
      <img src="https://ui-avatars.com/api/?name=<?= $_SESSION['username'] ?>&background=003366&color=fff&rounded=true&size=40" class="rounded-circle me-2" alt="Admin" width="40" height="40">
      <div>
        <div class="fw-bold"><?= $_SESSION['username'] ?></div>
        <small class="text-muted">Admin</small>
      </div>
    </div>
    <hr>
    <ul class="nav flex-column">
      <li class="nav-item mb-2">
        <a href="mobil/index.php" class="nav-link" onclick="loadPage(event, 'mobil/index.php')"><i class="bi bi-car-front me-2"></i>Data Mobil</a>
      </li>
      <li class="nav-item mb-2">
        <a href="pelanggan/index.php" class="nav-link" onclick="loadPage(event, 'pelanggan/index.php')"><i class="bi bi-person-lines-fill me-2"></i>Pelanggan</a>
      </li>
      <li class="nav-item mb-2">
        <a href="sewa/index.php" class="nav-link" onclick="loadPage(event, 'sewa/index.php')"><i class="bi bi-journal-check me-2"></i>Transaksi</a>
      </li>
      <li class="nav-item mb-2">
        <a href="laporan/index.php" class="nav-link" onclick="loadPage(event, 'laporan/index.php')"><i class="bi bi-bar-chart-line me-2"></i>Laporan</a>
      </li>
      <li class="nav-item mb-2">
        <a href="pembayaran/index.php" class="nav-link" onclick="loadPage(event, 'pembayaran/index.php')"><i class="bi bi-wallet2 me-2"></i>Pembayaran</a>
      </li>
      <li class="nav-item mt-4">
        <a href="../auth/logout.php" class="btn btn-outline-light btn-sm w-100"><i class="bi bi-box-arrow-right me-1"></i>Logout</a>
      </li>
    </ul>
  </div>

  <!-- Page Content -->
  <div class="flex-grow-1">
    <!-- Top Navbar -->
    <nav class="navbar navbar-light bg-white border-bottom px-4 shadow-sm">
      <button class="btn btn-outline-primary me-3 d-md-none" id="toggleSidebar"><i class="bi bi-list"></i></button>
      <span class="navbar-brand fw-bold">Dashboard Admin RentEase</span>
    </nav>

    <!-- Main Iframe Content -->
    <iframe id="mainContent" src="welcome.php"></iframe>
  </div>
</div>

<!-- Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const toggleSidebar = document.getElementById('toggleSidebar');
  const sidebar = document.getElementById('sidebar');

  toggleSidebar?.addEventListener('click', () => {
    sidebar.style.marginLeft = sidebar.style.marginLeft === '-250px' ? '0' : '-250px';
  });

  function loadPage(event, url) {
    event.preventDefault();
    document.getElementById('mainContent').src = url;
  }

  // Hide sidebar on mobile by default
  if (window.innerWidth < 768) {
    sidebar.style.marginLeft = '-250px';
  }
</script>
</body>
</html>
