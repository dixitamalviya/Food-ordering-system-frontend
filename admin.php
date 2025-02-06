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

// Check if the form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullName'];
    $course = $_POST['course'];
    $semester = $_POST['semester'];
    $enrollmentNumber = $_POST['enrollmentNumber'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // You need to define how to get the items and totalPrice from the form submission
    // If these fields are part of the form, include them as hidden inputs or add additional fields accordingly
    $items = ""; // Update this to get the items data from the form submission
    $totalPrice = ""; // Update this to get the totalPrice data from the form submission

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO orders (fullName, course, semester, enrollmentNumber, email, phone, items, totalPrice) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $fullName, $course, $semester, $enrollmentNumber, $email, $phone, $items, $totalPrice);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>