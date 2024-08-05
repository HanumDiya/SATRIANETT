<?php
session_start();
$servername = "localhost"; // or your database server
$db_user = "root"; // your database username
$db_passw = ""; // your database password
$dbname = "satrianet";

// Create connection
$conn = new mysqli($servername, $db_user, $db_passw, $dbname);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    $response = ['status' => 'error', 'message' => ''];

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if ($username == '' || $password == '') {
            $response['message'] = "Silahkan masukkan username dan juga password.";
        } else {
            $sql1 = "SELECT * FROM users WHERE username = ?";
            $stmt = $conn->prepare($sql1);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $r1 = $result->fetch_assoc();

            if ($r1 === null) {
                $response['message'] = "Username <b>$username</b> tidak tersedia";
            } elseif ($r1['password'] != md5($password)) {
                $response['message'] = "Password salah";
            } else {
                $_SESSION['session_username'] = $username;
                $_SESSION['session_password'] = md5($password);
                $response['status'] = 'success';
                $response['message'] = "Kamu berhasil login!";
            }
        }
    }

    echo json_encode($response);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="background">
        <img src="asset/Untitled design.png" alt="">
    </div>
    <div class="login-container">
        <h1>Login</h1>
        <form id="loginForm" method="post">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <p id="error-message" class="error-message"></p>
            <button type="submit" name="users">Login</button>
        </form>
        <p id="success-message" class="success-message"></p>
    </div>
    <script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(event.target);

        fetch('index.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Show success message
                document.getElementById('success-message').textContent = data.message;
                // Redirect after a delay
                setTimeout(() => {
                    window.location.href = 'dashboard.php';
                }, 2000);
            } else {
                // Display error message
                document.getElementById('error-message').innerHTML = data.message;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('error-message').textContent = 'An error occurred';
        });
    });
    </script>
</body>
</html>
