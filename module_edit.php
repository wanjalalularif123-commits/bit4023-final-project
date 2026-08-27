<?php
require 'php/session.php';
require 'php/db.php';

if (($_SESSION['role'] ?? '') !== 'lecturer') {
    header("Location: dashboard.php");
    exit;
}

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

if (!$course) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Course - Course Registration System</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php require 'includes/header.php'; ?>

<main>
  <div class="form-container">
    <h2>Edit Course</h2>
    <form method="POST" action="module_edit.php">
      <input type="hidden" name="id" value="<?= $course['id'] ?>">
      <div class="form-group">
        <label for="course_code">Course Code</label>
        <input type="text" id="course_code" name="course_code" value="<?= htmlspecialchars($course['course_code']) ?>" required>
      </div>
      <div class="form-group">
        <label for="course_name">Course Name</label>
        <input type="text" id="course_name" name="course_name" value="<?= htmlspecialchars($course['course_name']) ?>" required>
      </div>
      <div class="form-group">
        <label for="schedule">Schedule</label>
        <input type="text" id="schedule" name="schedule" value="<?= htmlspecialchars($course['schedule']) ?>" required>
      </div>
      <div class="form-group">
        <label for="seats_available">Seats Available</label>
        <input type="number" id="seats_available" name="seats_available" min="0" value="<?= $course['seats_available'] ?>" required>
      </div>
      <button type="submit" class="btn">Save Changes</button>
    </form>
    <p class="form-footer"><a href="dashboard.php">&larr; Back to Dashboard</a></p>
  </div>
</main>

<?php require 'includes/footer.php'; ?>

</body>
</html>