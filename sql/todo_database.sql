
CREATE DATABASE todo_app;


USE todo_app;


CREATE TABLE todos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task VARCHAR(255) NOT NULL,
    completed TINYINT(1) DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


INSERT INTO todos (task, completed) VALUES 
('Belajar PHP', 0),
('Membuat aplikasi to-do list', 0), 
('Review kode program', 0);