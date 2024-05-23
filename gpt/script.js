document.addEventListener('DOMContentLoaded', function () {
    const taskForm = document.getElementById('taskForm');
    const taskInput = document.getElementById('taskInput');
    const taskList = document.getElementById('taskList');
    const showAllTasks = document.getElementById('showAllTasks');

    taskForm.addEventListener('submit', function (e) {
        e.preventDefault();
        addTask(taskInput.value);
    });

    showAllTasks.addEventListener('click', function () {
        fetchTasks();
    });

    function addTask(task) {
        if (task === '') return;

        fetch('add_task.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'task=' + encodeURIComponent(task)
        })
            .then(response => response.text())
            .then(data => {
                if (data !== 'Duplicate task') {
                    taskInput.value = '';
                    fetchTasks();
                } else {
                    alert('Duplicate task');
                }
            });
    }

    function fetchTasks() {
        fetch('tasks.php')
            .then(response => response.json())
            .then(tasks => {
                taskList.innerHTML = '';
                tasks.forEach(task => {
                    const taskItem = document.createElement('li');
                    taskItem.textContent = task.task;

                    const deleteButton = document.createElement('button');
                    deleteButton.textContent = 'Delete';
                    deleteButton.addEventListener('click', () => {
                        if (confirm('Are you sure to delete this task?')) {
                            deleteTask(task.id);
                        }
                    });

                    const completeCheckbox = document.createElement('input');
                    completeCheckbox.type = 'checkbox';
                    completeCheckbox.checked = task.is_completed;
                    completeCheckbox.addEventListener('click', () => {
                        completeTask(task.id);
                    });

                    taskItem.appendChild(completeCheckbox);
                    taskItem.appendChild(deleteButton);
                    taskList.appendChild(taskItem);
                });
            });
    }

    function deleteTask(taskId) {
        fetch('delete_task.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'task_id=' + taskId
        })
            .then(response => response.text())
            .then(data => {
                fetchTasks();
            });
    }

    function completeTask(taskId) {
        fetch('complete_task.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'task_id=' + taskId
        })
            .then(response => response.text())
            .then(data => {
                fetchTasks();
            });
    }

    fetchTasks();
});
