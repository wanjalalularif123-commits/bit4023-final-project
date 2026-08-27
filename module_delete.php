<?php
require 'php/session.php';
require 'php/db.php';

if (($_SESSION['role'] ?? '') !== 'lecturer') {
    header("Location: dashboard.php");
    exit;
}

// Member 4: handle Delete
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM courses WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: dashboard.php");
exit;
