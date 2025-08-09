<?php
require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("INSERT INTO tasks (user_id, title, description, due_date) VALUES (?, ?, ?, ?)");
    $stmt->execute([1, $_POST['title'], $_POST['description'], $_POST['due_date']]); // user_id=1 for now
    echo "Task added!";
}
?>
<form method="POST">
    <input type="text" name="title" placeholder="Task Title" required><br>
    <textarea name="description" placeholder="Task Details"></textarea><br>
    <input type="date" name="due_date"><br>
    <button type="submit">Add Task</button>
</form>




