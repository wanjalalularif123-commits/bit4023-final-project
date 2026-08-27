<?php
require 'php/session.php';
require 'php/db.php';

$userId = $_SESSION['user_id'];
$courseId = (int) ($_GET['id'] ?? 0);

if ($courseId > 0) {
    $check = $conn->prepare("SELECT id FROM enrollments WHERE user_id = ? AND course_id = ?");
    $check->bind_param("ii", $userId, $courseId);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $conn->begin_transaction();
        try {
            $delete = $conn->prepare("DELETE FROM enrollments WHERE user_id = ? AND course_id = ?");
            $delete->bind_param("ii", $userId, $courseId);
            $delete->execute();

            $update = $conn->prepare("UPDATE courses SET seats_available = seats_available + 1 WHERE id = ?");
            $update->bind_param("i", $courseId);
            $update->execute();

            $conn->commit();
        } catch (Exception $e) {
            $conn->rollback();
        }
    }
}

header("Location: dashboard.php");
exit;
