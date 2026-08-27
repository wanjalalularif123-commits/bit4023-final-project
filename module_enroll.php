<?php
require 'php/session.php';
require 'php/db.php';

$userId = $_SESSION['user_id'];
$courseId = (int) ($_GET['id'] ?? 0);

if ($courseId > 0) {
    // Check the course exists and has seats available
    $stmt = $conn->prepare("SELECT seats_available FROM courses WHERE id = ?");
    $stmt->bind_param("i", $courseId);
    $stmt->execute();
    $course = $stmt->get_result()->fetch_assoc();

    if ($course && $course['seats_available'] > 0) {
        // Prevent duplicate enrollment (also enforced by the UNIQUE key in the DB)
        $check = $conn->prepare("SELECT id FROM enrollments WHERE user_id = ? AND course_id = ?");
        $check->bind_param("ii", $userId, $courseId);
        $check->execute();
        $check->store_result();

        if ($check->num_rows === 0) {
            $conn->begin_transaction();
            try {
                $insert = $conn->prepare("INSERT INTO enrollments (user_id, course_id) VALUES (?, ?)");
                $insert->bind_param("ii", $userId, $courseId);
                $insert->execute();

                $update = $conn->prepare("UPDATE courses SET seats_available = seats_available - 1 WHERE id = ? AND seats_available > 0");
                $update->bind_param("i", $courseId);
                $update->execute();

                $conn->commit();
            } catch (Exception $e) {
                $conn->rollback();
            }
        }
    }
}

header("Location: dashboard.php");
exit;
