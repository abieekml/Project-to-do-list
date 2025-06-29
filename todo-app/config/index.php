<?php
session_start();
require_once 'classes/TodoManager.php';

$todoManager = new TodoManager();
$message = '';
$messageType = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                if (!empty($_POST['task'])) {
                    if ($todoManager->addTodo($_POST['task'])) {
                        $message = 'Tugas berhasil ditambahkan!';
                        $messageType = 'success';
                    } else {
                        $message = 'Gagal menambahkan tugas!';
                        $messageType = 'error';
                    }
                }
                break;
                
            case 'toggle':
                if ($todoManager->toggleTodo($_POST['id'])) {
                    $message = 'Status tugas berhasil diubah!';
                    $messageType = 'success';
                }
                break;
                
            case 'delete':
                if ($todoManager->deleteTodo($_POST['id'])) {
                    $message = 'Tugas berhasil dihapus!';
                    $messageType = 'success';
                }
                break;
        }
    }
}

// Get filter parameter
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
$todos = $todoManager->getAllTodos($filter);

// Get counts for statistics
$totalCount = $todoManager->getCount('all');
$completedCount = $todoManager->getCount('completed');
$pendingCount = $todoManager->getCount('pending');

include 'includes/header.php';
?>

<main>
    <!-- Statistics -->
    <div class="stats">
        <div class="stat-item">
            <span class="stat-number"><?php echo $totalCount; ?></span>
            <span class="stat-label">Total Tugas</span>
        </div>
        <div class="stat-item">
            <span class="stat-number"><?php echo $completedCount; ?></span>
            <span class="stat-label">Selesai</span>
        </div>
        <div class="stat-item">
            <span class="stat-number"><?php echo $pendingCount; ?></span>
            <span class="stat-label">Belum Selesai</span>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="filter-tabs">
        <a href="?filter=all" class="filter-tab <?php echo $filter === 'all' ? 'active' : ''; ?>">
            <i class="fas fa-list"></i> Semua
        </a>
        <a href="?filter=pending" class="filter-tab <?php echo $filter === 'pending' ? 'active' : ''; ?>">
            <i class="fas fa-clock"></i> Belum Selesai
        </a>
        <a href="?filter=completed" class="filter-tab <?php echo $filter === 'completed' ? 'active' : ''; ?>">
            <i class="fas fa-check-circle"></i> Selesai
        </a>
    </div>

    <!-- Add Todo Form -->
    <div class="todo-form">
        <?php if ($message): ?>
            <div class="<?php echo $messageType; ?>-message">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="input-group">
                <input type="text" name="task" placeholder="Masukkan tugas baru..." required>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Tugas
                </button>
            </div>
            <input type="hidden" name="action" value="add">
        </form>
    </div>

    <!-- Todo List -->
    <div class="todo-list">
        <?php if (empty($todos)): ?>
            <div class="empty-state">
                <i class="fas fa-clipboard-list"></i>
                <h3>Tidak ada tugas</h3>
                <p>
                    <?php
                    switch($filter) {
                        case 'completed':
                            echo 'Belum ada tugas yang selesai.';
                            break;
                        case 'pending':
                            echo 'Semua tugas sudah selesai! 🎉';
                            break;
                        default:
                            echo 'Mulai dengan menambahkan tugas pertama Anda.';
                    }
                    ?>
                </p>
            </div>
        <?php else: ?>
            <?php foreach ($todos as $todo): ?>
                <div class="todo-item <?php echo $todo['completed'] ? 'completed' : ''; ?>">
                    <div class="todo-text">
                        <?php echo htmlspecialchars($todo['task']); ?>
                        <small style="display: block; color: #6c757d; margin-top: 5px;">
                            Dibuat: <?php echo date('d/m/Y H:i', strtotime($todo['created_at'])); ?>
                        </small>
                    </div>
                    <div class="todo-actions">
                        <!-- Toggle Status -->
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="action" value="toggle">
                            <input type="hidden" name="id" value="<?php echo $todo['id']; ?>">
                            <button type="submit" class="btn btn-success" title="<?php echo $todo['completed'] ? 'Tandai belum selesai' : 'Tandai selesai'; ?>">
                                <i class="fas <?php echo $todo['completed'] ? 'fa-undo' : 'fa-check'; ?>"></i>
                            </button>
                        </form>
                        
                        <!-- Delete -->
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?php echo $todo['id']; ?>">
                            <button type="submit" class="btn btn-danger" title="Hapus tugas">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</main>

<?php include 'includes/footer.php'; ?>