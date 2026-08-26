<?php
$result = $conn->query("SELECT * FROM courses ORDER BY id DESC");
?>

<h3>Course List</h3>
<table>
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
  <label>Seats Available: <input type="number" name="seats_available" required></label>
  <button type="submit">Add</button>
</form>