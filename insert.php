<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_detail";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item = $_POST['item'];
    $quantity = $_POST['quantity'];
    $rate = $_POST['rate'];

    $sql = "INSERT INTO staff (item, quantity, rate) VALUES ('$item', '$quantity', '$rate')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
