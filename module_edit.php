<?php
require 'php/session.php';
require 'php/db.php';

$id = (int)($_GET['id'] ?? $_POST['id'] ?? 0);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $course_code = trim($_POST['course_code']);
    $course_name = trim($_POST['course_name']);
    $schedule = trim($_POST['schedule']);
    $seats_available = (int)$_POST['seats_available'];

    $stmt = $conn->prepare("UPDATE courses SET course_code=?, course_name=?, schedule=?, seats_available=? WHERE id=?");
    $stmt->bind_param("sssii", $course_code, $course_name, $schedule, $seats_available, $id);
    $stmt->execute();

    header("Location: dashboard.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM courses WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$course = $stmt->get_result()->fetch_assoc();

require 'includes/header.php';
?>
<h2>Edit Course</h2>
<form method="POST" action="module_edit.php">
  <input type="hidden" name="id" value="<?= $course['id'] ?>">
  <label>Course Code: <input type="text" name="course_code" value="<?= htmlspecialchars($course['course_code']) ?>" required></label>
  <label>Course Name: <input type="text" name="course_name" value="<?= htmlspecialchars($course['course_name']) ?>" required></label>
  <label>Schedule: <input type="text" name="schedule" value="<?= htmlspecialchars($course['schedule']) ?>" required></label>
  <label>Seats Available: <input type="number" name="seats_available" value="<?= $course['seats_available'] ?>" required></label>
  <button type="submit">Save Changes</button>
</form>
<?php require 'includes/footer.php'; ?>