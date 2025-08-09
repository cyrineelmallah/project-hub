<?php
require 'includes/db.php';

// Make sure the task ID exists in the URL
if (!isset($_GET['id'])) {
    die("Task ID not provided.");
}

$id = (int) $_GET['id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE tasks SET title = ?, description = ?, due_date = ?, status = ? WHERE id = ?");
    $stmt->execute([$title, $description, $due_date, $status, $id]);

    echo "Task updated successfully! <a href='index.php'>Go back</a>";
    exit;
}

// Fetch task data
$stmt = $conn->prepare("SELECT * FROM tasks WHERE id = ?");
$stmt->execute([$id]);
$task = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$task) {
    die("Task not found.");
}
?>

<h2>Edit Task</h2>
<form method="POST">
    <input type="text" name="title" value="<?= htmlspecialchars($task['title']) ?>" required><br>
    <textarea name="description"><?= htmlspecialchars($task['description']) ?></textarea><br>
    <input type="date" name="due_date" value="<?= $task['due_date'] ?>"><br>
    <select name="status">
        <option value="pending" <?= $task['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
        <option value="in-progress" <?= $task['status'] == 'in-progress' ? 'selected' : '' ?>>In Progress</option>
        <option value="completed" <?= $task['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
    </select><br>
    <button type="submit">Update Task</button>
</form>