<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');

    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "masuk2";

    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT id, nama_pengguna, password FROM datadata WHERE nama_pengguna='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            header("Location: beranda.php");
    exit(); // Pastikan untuk keluar agar kode di bawahnya tidak dieksekusi setelah pengalihan header
} else {
    echo "Password salah";
}
    } else {
        echo "Pengguna tidak ditemukan!";
    }

    $conn->close();
}
?>
