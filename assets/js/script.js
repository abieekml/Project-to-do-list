document.addEventListener('DOMContentLoaded', function() {
    // Auto hide success/error messages
    const messages = document.querySelectorAll('.success-message, .error-message');
    messages.forEach(function(message) {
        setTimeout(function() {
            message.style.opacity = '0';
            setTimeout(function() {
                message.remove();
            }, 300);
        }, 3000);
    });

    // Confirm delete action
    const deleteButtons = document.querySelectorAll('.btn-danger');
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function(e) {
            if (!confirm('Apakah Anda yakin ingin menghapus tugas ini?')) {
                e.preventDefault();
            }
        });
    });

    // Focus on input field when page loads
    const todoInput = document.querySelector('input[name="task"]');
    if (todoInput) {
        todoInput.focus();
    }

    // Handle form submission with Enter key
    const todoForm = document.querySelector('.todo-form form');
    if (todoForm) {
        todoForm.addEventListener('submit', function(e) {
            const taskInput = todoForm.querySelector('input[name="task"]');
            if (taskInput.value.trim() === '') {
                e.preventDefault();
                alert('Silakan masukkan tugas yang ingin ditambahkan!');
                taskInput.focus();
            }
        });
    }

    // Add smooth transitions for todo items
    const todoItems = document.querySelectorAll('.todo-item');
    todoItems.forEach(function(item, index) {
        item.style.opacity = '0';
        item.style.transform = 'translateY(20px)';
        setTimeout(function() {
            item.style.transition = 'all 0.3s ease';
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
        }, index * 100);
    });

    // Add loading state for buttons
    const actionButtons = document.querySelectorAll('.btn-success, .btn-danger');
    actionButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            button.disabled = true;
            
            // Re-enable after a short delay (in real app, this would be after AJAX response)
            setTimeout(function() {
                button.innerHTML = originalText;
                button.disabled = false;
            }, 1000);
        });
    });
});