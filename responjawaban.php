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
$dbname = "masuk2"; // Replace with your actual database name

$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the question ID is provided in the URL
if (!isset($_GET['question_id'])) {
    echo "Invalid question ID";
    exit();
}

$questionId = $_GET['question_id'];

// Retrieve the question details from the database
$questionSql = "SELECT * FROM komentar WHERE id = $questionId";
$questionResult = $conn->query($questionSql);

if ($questionResult && $questionResult->num_rows > 0) {
    $questionRow = $questionResult->fetch_assoc();
    $questionerName = $questionRow['nama'];
    $questionContent = $questionRow['komen'];
} else {
    echo "Question not found";
    exit();
}

// Retrieve responses for the question
$responseSql = "SELECT * FROM respon WHERE id = $questionId ORDER BY id_respon DESC";
$responseResult = $conn->query($responseSql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <h3>pertanyaan:</h3>
    <p><?php echo $questionerName; ?>: <?php echo $questionContent; ?></p>

    <h3>Respon:</h3>
    <?php
    if ($responseResult && $responseResult->num_rows > 0) {
        while ($responseRow = $responseResult->fetch_assoc()) {
            echo "<p>" . $responseRow['nama'] . ": " . $responseRow['isirespon'] . "</p>";
        }
    } else {
        echo "*Belum ada respon*";
    }
    ?>

    <!-- Add a form for submitting new responses if needed -->
    <br>
    <br>
    <a href="beranda.php" style="text-decoration: none;">kembali</a>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
