<?php
$role = $_SESSION['role'] ?? 'student';
$userId = $_SESSION['user_id'];

if ($role === 'lecturer'):
    // ---------- Lecturer view: manage all courses ----------
    $result = $conn->query("SELECT * FROM courses ORDER BY id DESC");
?>
  <h3>Course List</h3>
  <table class="data-table">
    <tr>
      <th>Code</th>
      <th>Name</th>
      <th>Schedule</th>
      <th>Seats</th>
      <th>Actions</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?php echo htmlspecialchars($row['course_code']); ?></td>
        <td><?php echo htmlspecialchars($row['course_name']); ?></td>
        <td><?php echo htmlspecialchars($row['schedule']); ?></td>
        <td><?php echo $row['seats_available']; ?></td>
        <td>
          <a href="module_edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
          <a href="module_delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this course?')">Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>

  <h3>Add New Course</h3>
  <form method="POST" action="module_create.php">
    <label>Course Code: <input type="text" name="course_code" required></label>
    <label>Course Name: <input type="text" name="course_name" required></label>
    <label>Schedule: <input type="text" name="schedule" required></label>
    <label>Seats Available: <input type="number" name="seats_available" min="0" required></label>
    <button type="submit">Add</button>
  </form>

<?php else: ?>

  <?php
    // ---------- Student view: browse + enroll ----------
    $enrolledResult = $conn->prepare(
        "SELECT c.* FROM courses c
         INNER JOIN enrollments e ON e.course_id = c.id
         WHERE e.user_id = ? ORDER BY c.id DESC"
    );
    $enrolledResult->bind_param("i", $userId);
    $enrolledResult->execute();
    $enrolledCourses = $enrolledResult->get_result();
    $enrolledIds = [];
    $enrolledRows = [];
    while ($row = $enrolledCourses->fetch_assoc()) {
        $enrolledIds[] = $row['id'];
        $enrolledRows[] = $row;
    }

    $availableResult = $conn->query("SELECT * FROM courses ORDER BY id DESC");
  ?>

  <h3>My Enrolled Courses</h3>
  <?php if (empty($enrolledRows)): ?>
    <p>You have not enrolled in any courses yet.</p>
  <?php else: ?>
    <table class="data-table">
      <tr>
        <th>Code</th>
        <th>Name</th>
        <th>Schedule</th>
        <th>Actions</th>
      </tr>
      <?php foreach ($enrolledRows as $row): ?>
        <tr>
          <td><?php echo htmlspecialchars($row['course_code']); ?></td>
          <td><?php echo htmlspecialchars($row['course_name']); ?></td>
          <td><?php echo htmlspecialchars($row['schedule']); ?></td>
          <td>
            <a href="module_drop.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Drop this course?')">Drop</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  <?php endif; ?>

  <h3>Available Courses</h3>
  <table class="data-table">
    <tr>
      <th>Code</th>
      <th>Name</th>
      <th>Schedule</th>
      <th>Seats</th>
      <th>Actions</th>
    </tr>
    <?php while ($row = $availableResult->fetch_assoc()): ?>
      <tr>
        <td><?php echo htmlspecialchars($row['course_code']); ?></td>
        <td><?php echo htmlspecialchars($row['course_name']); ?></td>
        <td><?php echo htmlspecialchars($row['schedule']); ?></td>
        <td><?php echo $row['seats_available']; ?></td>
        <td>
          <?php if (in_array($row['id'], $enrolledIds, true)): ?>
            <span class="badge">Enrolled</span>
          <?php elseif ($row['seats_available'] <= 0): ?>
            <span class="badge full">Full</span>
          <?php else: ?>
            <a href="module_enroll.php?id=<?php echo $row['id']; ?>">Select</a>
          <?php endif; ?>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>

<?php endif; ?>
