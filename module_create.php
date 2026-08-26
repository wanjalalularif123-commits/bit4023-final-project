<?php
require 'php/session.php';
require 'php/db.php';

// Member 4: handle Create
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $course_code = trim($_POST['course_code']);
    $course_name = trim($_POST['course_name']);
    $schedule = trim($_POST['schedule']);
    $seats_available = (int)$_POST['seats_available'];

    $stmt = $conn->prepare("INSERT INTO courses (course_code, course_name, schedule, seats_available) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $course_code, $course_name, $schedule, $seats_available);
    $stmt->execute();
}

header("Location: dashboard.php");
exit;
