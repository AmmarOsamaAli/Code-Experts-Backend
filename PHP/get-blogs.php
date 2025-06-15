<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Credentials: true');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

include 'db.php';
$result = $conn->query("SELECT * FROM blogs ORDER BY created_at DESC");
$blogs = [];
while ($row = $result->fetch_assoc()) {
    $blogs[] = $row;
}
echo json_encode($blogs);
?>