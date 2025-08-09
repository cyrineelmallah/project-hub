<?php
require 'includes/db.php';

// Make sure the task ID exists
if (!isset($_GET['id'])) {
    die("Task ID not provided.");
}

$id = (int) $_GET['id'];

// Delete task
$stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
$stmt->execute([$id]);

// Redirect to task list
header("Location: index.php");
exit;
?>


