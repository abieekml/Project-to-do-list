<?php
require_once 'config/database.php';

class TodoManager {
    private $conn;
    private $table = 'todos';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Mendapatkan semua todo
    public function getAllTodos($filter = 'all') {
        $query = "SELECT * FROM " . $this->table;
        
        switch($filter) {
            case 'completed':
                $query .= " WHERE completed = 1";
                break;
            case 'pending':
                $query .= " WHERE completed = 0";
                break;
        }
        
        $query .= " ORDER BY created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Menambah todo baru
    public function addTodo($task) {
        $query = "INSERT INTO " . $this->table . " (task) VALUES (:task)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':task', $task);
        return $stmt->execute();
    }

    // Update status todo (completed/pending)
    public function toggleTodo($id) {
        $query = "UPDATE " . $this->table . " SET completed = NOT completed WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Menghapus todo
    public function deleteTodo($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Mendapatkan jumlah todo berdasarkan status
    public function getCount($status = 'all') {
        $query = "SELECT COUNT(*) as count FROM " . $this->table;
        
        if ($status === 'completed') {
            $query .= " WHERE completed = 1";
        } elseif ($status === 'pending') {
            $query .= " WHERE completed = 0";
        }
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }
}
?>