 <?php
require 'includes/db.php';

$stmt = $conn->prepare("SELECT * FROM tasks ORDER BY due_date ASC");
$stmt->execute();
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($tasks as $task) {
    echo "<h3>{$task['title']}</h3>";
    echo "<p>{$task['description']}</p>";
    echo "<small>Due: {$task['due_date']} | Status: {$task['status']}</small><hr>";
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Daily Planner</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

    <h1>My Daily Tasks</h1>

    <!-- Users Table -->
    <div class="users-list">
        <h2>Users</h2>
        <table border="1" cellpadding="8">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['id']) ?></td>
                        <td><?= htmlspecialchars($user['name']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['created_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>


<div class="container">

    <h1>My Daily Tasks</h1>

    <!-- Add Task Form -->
    <div class="form-container">
        <h2>Add New Task</h2>
        <form method="POST">
            <input type="hidden" name="add_task" value="1">
            <label>Title</label>
            <input type="text" name="title" placeholder="Task title" required>

            <label>Description</label>
            <textarea name="description" placeholder="Task details"></textarea>

            <label>Due Date</label>
            <input type="date" name="due_date">

            <button type="submit">Add Task</button>
        </form>
    </div>

    <!-- Task List -->
    <div class="tasks-list">
        <h2>Tasks</h2>
        <?php if (count($tasks) === 0): ?>
            <p>No tasks yet!</p>
        <?php else: ?>
            <?php foreach ($tasks as $task): ?>
                <div class="task-item">
                    <h3><?= htmlspecialchars($task['title']) ?></h3>
                    <p><?= nl2br(htmlspecialchars($task['description'])) ?></p>
                    <small>Due: <?= $task['due_date'] ?> | Status: <?= $task['status'] ?></small><br>
                    <a href="edit_task.php?id=<?= $task['id'] ?>">Edit</a> | 
                    <a href="delete_task.php?id=<?= $task['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </div>
                <hr>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</div>

</body>
</html>
