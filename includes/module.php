<?php
// Member 4: Application Module (Core Feature + CRUD)
// $conn is already available here (from db.php, required in dashboard.php)
//
// Example for a "list" feature — replace "items" with your actual table name
// once you've decided on your application (e.g. courses, appointments, notices).

$result = $conn->query("SELECT * FROM items ORDER BY created_at DESC");
?>

<h3>Your Items</h3>

<table>
  <tr>
    <th>Title</th>
    <th>Description</th>
    <th>Actions</th>
  </tr>
  <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?php echo htmlspecialchars($row['title']); ?></td>
      <td><?php echo htmlspecialchars($row['description']); ?></td>
      <td>
        <a href="module_edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
        <a href="module_delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this item?')">Delete</a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>

<h3>Add New Item</h3>
<form method="POST" action="module_create.php">
  <label>Title: <input type="text" name="title" required></label>
  <label>Description: <textarea name="description"></textarea></label>
  <button type="submit">Add</button>
</form>
