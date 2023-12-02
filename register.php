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

    $sql = "INSERT INTO datadata (nama_pengguna, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Registrasi berhasil, arahkan ke halaman login
        header("Location: login.html");
        exit(); // Pastikan untuk keluar agar kode di bawahnya tidak dieksekusi setelah pengalihan header
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<!-- Formulir registrasi dan HTML lainnya di sini -->