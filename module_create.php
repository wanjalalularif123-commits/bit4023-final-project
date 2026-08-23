<?php
require 'php/session.php';
require 'php/db.php';

// Member 4: handle Create
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);

    $stmt = $conn->prepare("INSERT INTO items (title, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $description);
    $stmt->execute();
}

header("Location: dashboard.php");
exit;
