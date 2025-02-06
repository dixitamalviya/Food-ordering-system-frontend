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
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT name FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);

    // Execute the statement
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($name);
        $stmt->fetch();
        echo "Login successful! Welcome, " . $name;
        // Redirect to the website or perform other actions
        header("Location: C:\Users\HP\Desktop\capstone\SmartCampus\index.html");
        exit();
    } else {
        echo "Invalid username or password.";
    }

    $stmt->close();
}

$conn->close();
?>
