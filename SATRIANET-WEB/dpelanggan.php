<?php
session_start();
include 'connect.php'; // Sertakan file koneksi database
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Satrianet | Data Pelanggan</title>
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- CSS File -->
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <section class="sidebar">
    <a href="dashboard.html" class="logo">
      <img src="asset/logo.png" alt="Satria Net Logo" class="logo-img">
      <span class="text">SATRIA NET</span>
    </a>
    
    <ul class="side-menu top">
      <li>
        <a href="dashboard.html" class="nav-link">
          <i class="fas fa-border-all"></i>
          <span class="text">Dashboard</span>
        </a>
      </li>
      <li class="active">
        <a href="dpelanggan.php" class="nav-link">
          <i class="fas fa-people-group"></i>
          <span class="text">Data Pelanggan</span>
        </a>
      </li>
      <li>
        <a href="data-teknis.html" class="nav-link">
          <i class="fas fa-cog"></i>
          <span class="text">Data Teknis</span>
        </a>
      </li>
      <li>
        <a href="pembayaran.html" class="nav-link">
          <i class="fas fa-money-bill"></i>
          <span class="text">Pembayaran</span>
        </a>
      </li>
      <li>
        <a href="inventori.html" class="nav-link">
          <i class="fas fa-box"></i>
          <span class="text">Inventori</span>
        </a>
      </li>
      <li>
        <a href="ticketing.html" class="nav-link">
          <i class="fas fa-ticket-alt"></i>
          <span class="text">Ticketing</span>
        </a>
      </li>
      <li>
        <a href="prt.html" class="nav-link">
          <i class="fas fa-tools"></i>
          <span class="text">PRT</span>
        </a>
      </li>
    </ul>
    
    <ul class="side-menu">
      <li>
        <a href="#" class="logout" id="logout-btn">
          <i class="fas fa-right-from-bracket"></i>
          <span class="text">Logout</span>
        </a>
      </li>
    </ul>
  </section>
  
  <section class="content">
    <nav>
      <i class="fas fa-bars menu-btn"></i>
      <a href="#" class="nav-link">Categories</a>
      <form action="#" method="GET">
        <div class="form-input">
          <input type="search" placeholder="search..." name="query">
          <button class="search-btn">
            <i class="fas fa-search search-icon"></i>
          </button>
        </div>
      </form>
      <a href="#" class="profile">
        <i class="fas fa-user"></i>
      </a>
    </nav>
    
    <main>
      <div class="head-title">
        <div class="left">
          <h1>Data Pelanggan</h1>
          <ul class="breadcrumb">
            <li>
              <a href="#">Data Pelanggan</a>
            </li>
            <i class="fas fa-chevron-right"></i>
            <li>
              <a href="#" class="active">Home</a>
            </li>
          </ul>
        </div>
      </div>
      
      <div class="table-data">
        <div class="order">
          <div class="head">
            <h3>Data Pelanggan</h3>
            <a href="add_pelanggan.php" class="add-btn">
              <i class="fas fa-plus"></i>
            </a>
            <i class="fas fa-filter"></i>
          </div>
          
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Akta</th>
                <th>NPWP</th>
                <th>KTP</th>
                <th>Domisili</th>
                <th>NIB</th>
                <th>KemenKumham</th>
                <th>Telp1</th>
                <th>Telp2</th>
                <th>Biaya Total</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // Ambil data dari tabel datapelanggan
              $sql = "SELECT id, akta, npwp, ktp, domisili, nib, kemen_kahham, telp1, telp2, biaya_total FROM datapelanggan";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                  // Output data dari setiap baris
                  while($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>" . $row["id"] . "</td>";
                      echo "<td>" . $row["akta"] . "</td>";
                      echo "<td>" . $row["npwp"] . "</td>";
                      echo "<td>" . $row["ktp"] . "</td>";
                      echo "<td>" . $row["domisili"] . "</td>";
                      echo "<td>" . $row["nib"] . "</td>";
                      echo "<td>" . $row["kemen_kahham"] . "</td>";
                      echo "<td>" . $row["telp1"] . "</td>";
                      echo "<td>" . $row["telp2"] . "</td>";
                      echo "<td>" . $row["biaya_total"] . "</td>";
                      echo "</tr>";
                  }
              } else {
                  echo "<tr><td colspan='10'>No data found</td></tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </section>
  
  <script src="js/app.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.getElementById('logout-btn').addEventListener('click', function(event) {
      event.preventDefault();

      // Tampilkan notifikasi logout berhasil
      Swal.fire({
        title: 'Anda berhasil logout!',
        icon: 'success',
        timer: 2000,
        timerProgressBar: true,
        didClose: () => {
          // Lakukan tindakan pembersihan yang diperlukan, misalnya menghapus token sesi pengguna

          // Arahkan ke halaman login
          window.location.href = 'index.php';
        }
      });
    });
  </script>
</body>
</html>
