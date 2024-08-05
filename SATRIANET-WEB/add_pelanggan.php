<?php
session_start();
include 'connect.php'; // Sertakan file koneksi database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $alamat = $_POST['alamat'];
    $akta = $_FILES['akta']['name'];
    $npwp = $_FILES['npwp']['name'];
    $ktp = $_FILES['ktp']['name'];
    $domisili = $_POST['domisili'];
    $nib = $_POST['nib'];
    $kemenkamhem = $_POST['kemenkamhem'];
    $phone1 = $_POST['phone1'];
    $phone2 = isset($_POST['phone2']) ? $_POST['phone2'] : null;

    // Upload files
    $akta_target = "uploads/" . basename($akta);
    $npwp_target = "uploads/" . basename($npwp);
    $ktp_target = "uploads/" . basename($ktp);

    move_uploaded_file($_FILES['akta']['tmp_name'], $akta_target);
    move_uploaded_file($_FILES['npwp']['tmp_name'], $npwp_target);
    move_uploaded_file($_FILES['ktp']['tmp_name'], $ktp_target);

    $sql = "INSERT INTO datapelanggan (name, alamat, akta, npwp, ktp, domisili, nib, kemen_kahham, telp1, telp2)
            VALUES ('$name', '$alamat', '$akta', '$npwp', '$ktp', '$domisili', '$nib', '$kemenkamhem', '$phone1', '$phone2')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Pelanggan</title>
    <link rel="stylesheet" href="css/form.css">
</head>
<body>
    <div class="background-decor"></div>
    <div class="form-container">
        <h3>Input Data Pelanggan</h3>
        <form id="customer-form" method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" id="name" name="name" required>
            </div>
            
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea id="alamat" name="alamat" placeholder="Masukkan alamat Anda" required></textarea>
            </div>
            
            <div class="form-group">
                <label for="akta">Foto Akta</label>
                <input type="file" id="akta" name="akta" accept="image/*" required>
            </div>
            
            <div class="form-group">
                <label for="npwp">Foto NPWP</label>
                <input type="file" id="npwp" name="npwp" accept="image/*" required>
            </div>
            
            <div class="form-group">
                <label for="ktp">Foto KTP</label>
                <input type="file" id="ktp" name="ktp" accept="image/*" required>
            </div>
            
            <div class="form-group">
                <label for="domisili">Domisili</label>
                <input type="text" id="domisili" name="domisili" required>
            </div>
            
            <div class="form-group">
                <label for="nib">NIB</label>
                <input type="text" id="nib" name="nib" required>
            </div>
            
            <div class="form-group">
                <label for="kemenkamhem">Kemenkamhem</label>
                <input type="text" id="kemenkamhem" name="kemenkamhem" required>
            </div>
            
            <div class="form-group">
                <label for="phone1">Nomor Telp 1</label>
                <input type="tel" id="phone1" name="phone1" required>
            </div>
            
            <div id="additional-phones"></div>
            
            <button type="button" id="add-phone-btn">Tambah Nomor Telp</button>
            
            <div class="form-group">
                <button type="submit">Save</button>
            </div>
        </form>
        <a href="dpelanggan.php">Kembali</a>
    </div>

    <script>
        document.getElementById('add-phone-btn').addEventListener('click', function() {
            const additionalPhones = document.getElementById('additional-phones');
            const phoneCount = additionalPhones.children.length + 2; // Start from phone2
            const newPhone = document.createElement('div');
            newPhone.className = 'form-group';
            newPhone.innerHTML = `<label for="phone${phoneCount}">Nomor Telp ${phoneCount}</label>
                                  <input type="tel" id="phone${phoneCount}" name="phone${phoneCount}" required>`;
            additionalPhones.appendChild(newPhone);
        });
    </script>
</body>
</html>
