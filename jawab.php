<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

// Assuming you have a database connection
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "masuk2";

$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the comment ID is provided in the URL
if (!isset($_GET['pertanyaan_id'])) {
    echo "Invalid comment ID";
    exit();
}

$commentId = $_GET['pertanyaan_id'];


// Retrieve the comment from the database based on the comment ID
$sql = "SELECT id, nama, komen FROM komentar WHERE id = $commentId";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $commentId = $row['id'];
    $commenterName = $row['nama'];
    $commentContent = $row['komen'];
} else {
    echo "Comment not found";
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $responseContent = $_POST['response_content'];
    $responderName = $_SESSION['username'];

    // Insert the response into the database
    $insertResponseSql = "INSERT INTO respon (id, nama, isirespon) VALUES ($commentId, '$responderName', '$responseContent')";
    if ($conn->query($insertResponseSql) === TRUE) {
        echo "Response added successfully";
    } else {
        echo "Error adding response: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
	<center>
    <h3>Pertanyaan:</h3>
    <p><strong><?php echo $commenterName; ?>:</strong> <?php echo $commentContent; ?></p>

    <h3>Respon Anda:</h3>
    <form action="" method="POST">
        <label for="response_content">Your Response:</label><br>
        <textarea name="response_content" id="response_content" rows="5" cols="35" required></textarea><br>
        <button type="submit">Kirim Respon</button>
    </form>
    <a href="beranda.php" style="text-decoration: none;">Kembali ke Beranda</a>
    </center>
</body>
</html>
