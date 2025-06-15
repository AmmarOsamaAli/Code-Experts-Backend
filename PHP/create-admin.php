<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "code-experts-backend"; // Make sure this matches your actual DB name

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set your admin credentials here
$username = "admin1";
$password = "admin1234"; // Replace with the password you want

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert admin user
$stmt = $conn->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hashedPassword);

if ($stmt->execute()) {
    echo "✅ Admin user created successfully.";
} else {
    echo "❌ Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
