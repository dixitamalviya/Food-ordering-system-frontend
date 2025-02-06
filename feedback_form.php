<?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = htmlspecialchars($_POST['name']);
            $email = htmlspecialchars($_POST['email']);
            $feedback = htmlspecialchars($_POST['feedback']);

            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "login_detail"; // Replace with your database name

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Insert feedback into the database
            $sql = "INSERT INTO feedback (name, email, feedback) VALUES ('$name', '$email', '$feedback')";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success'>Feedback submitted successfully!</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
            }

            $conn->close();

            // Send feedback to admin email
            $to = "malviyamikku2.0@gmail.com"; // Replace with admin email
            $subject = "New Feedback from $name";
            $message = "Name: $name\nEmail: $email\nFeedback: $feedback";
            $headers = "From: $email";

            if (mail($to, $subject, $message, $headers)) {
                echo "<div class='alert alert-success'>Feedback submitted successfully!</div>";
            } else {
                echo "<div class='alert alert-danger'>Failed to send feedback.</div>";
            }
        }
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container" style="margin-top: 50px;">
        <h2>Feedback Form</h2>
        
        <form action="" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="feedback">Feedback:</label>
                <textarea class="form-control" id="feedback" name="feedback" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
