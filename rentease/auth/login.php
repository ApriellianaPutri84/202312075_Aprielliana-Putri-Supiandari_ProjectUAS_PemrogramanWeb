<?php
session_start();
include('../config/koneksi.php');

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        $_SESSION['login'] = true;
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['username'] = $data['username'];
        header("Location: ../admin/dashboard.php");
        exit;
    } else {
        echo "<script>alert('Login gagal! Username atau password salah.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login - RentEase</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #e3f2fd, #ffffff);
      font-family: 'Segoe UI', sans-serif;
    }
    .card {
      border: none;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    .card-header {
      background: linear-gradient(90deg, #2196f3, #64b5f6);
      color: white;
      border-top-left-radius: 16px;
      border-top-right-radius: 16px;
    }
    .btn-primary {
      background-color: #2196f3;
      border: none;
      border-radius: 8px;
    }
    .btn-primary:hover {
      background-color: #1976d2;
    }
  </style>
</head>
<body>
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <div class="card shadow">
        <div class="card-header text-center py-3">
          <h4 class="mb-0">🔐 RentEase Login</h4>
        </div>
        <div class="card-body">
          <form method="POST">
            <div class="mb-3">
              <label>Username</label>
              <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
              <label>Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
