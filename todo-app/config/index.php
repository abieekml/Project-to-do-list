<?php
require_once __DIR__ . '/todo-app/config/database.php';
require_once __DIR__ . '/classes/TodoManager.php';

$database = new Database();
$db_connection = $database->connect(); 

$todoManager = new TodoManager($db_connection);
$todos = $todoManager->getTodos();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>To-Do List</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'database/includes/header.php'; ?>

    <div class="container">
        <h2>My To-Do List</h2>

        <form method="post" action="todo-app/config/index.php">
            <input type="text" name="task" placeholder="Add new task" required>
            <input type="hidden" name="action" value="add">
            <button type="submit">Add Task</button>
        </form>

        <ul class="todo-list">
            <?php foreach ($todos as $todo): ?>
                <li>
                    <form method="post" action="todo-app/config/index.php" style="display:inline;">
                        <input type="hidden" name="action" value="toggle">
                        <input type="hidden" name="id" value="<?= $todo['id'] ?>">
                        <button type="submit" style="background:none;border:none;">
                            <?= $todo['completed'] ? '✅' : '⬜' ?>
                        </button>
                    </form>
                    <?= htmlspecialchars($todo['task']) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <?php include 'database/includes/footer.php'; ?>
</body>
</html>