<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: POST');
session_start();

if (!isset($_SESSION['admin'])) {
    echo json_encode(['success' => false, 'error' => 'Unauthorized']);
    exit;
}

include 'db.php';
$data = json_decode(file_get_contents("php://input"), true);
$title = $data['title'] ?? '';
$content = $data['content'] ?? '';

if ($title && $content) {
    $stmt = $conn->prepare("INSERT INTO blogs (title, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $content);
    $stmt->execute();
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Missing fields']);
}
?>