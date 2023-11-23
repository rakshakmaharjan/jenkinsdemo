<?php
// Replace these values with your actual database credentials
$hostname = "your_database_hostname";
$username = "your_database_username";
$password = "your_database_password";
$database = "your_database_name";

// Connect to the database
$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare and execute a SELECT query to check user credentials
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $response = array("success" => true);
    } else {
        $response = array("success" => false);
    }

    echo json_encode($response);
}
?>
