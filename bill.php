
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

// Check if the form data is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $data = json_decode(file_get_contents("php://input"), true);
    // echo $data;
    // die;
    // Extract form data
    $fullName = $_POST['fullName'];
    $enrollmentNumber = $_POST['enrollmentNumber'];
    $phone = $_POST['phone'];
    $course = $_POST['item'];
    $semester = $_POST['quantity'];
    $email = $_POST['total_price'];
    // $items = json_encode($data['items']);  // Convert items array to JSON
    // $totalPrice = $_POST['totalPrice'];

    // Prepare and bind
    // $stmt = $conn->prepare("INSERT INTO orders (fullName, course, semester, enrollmentNumber, email, phone, totalPrice) VALUES (?, ?, ?, ?, ?, ?, ?)");
    // $stmt->bind_param("ssssssss", $fullName, $course, $semester, $enrollmentNumber, $email, $phone, $totalPrice);

    $stmt = $conn->prepare("INSERT INTO orders (fullName, enrollmentNumber, phone, item, quantity, total_price) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $fullName, $enrollmentNumber, $phone, $item, $quantity, $total_price);


    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(["success" => "Data inserted successfully"]);
    } else {
        echo json_encode(["error" => "Error: " . $stmt->error]);
    }

    $stmt->close();
}

$conn->close();
?>