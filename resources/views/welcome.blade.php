<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Task Manager</title>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        /* Your CSS code */
        :root {
            --theme-color: #FADADD;
            --theme-color-dark: #F8C8CC;
            --theme-color-light: #FDF2F3;
            --priority-high: #dc3545;
            --priority-medium: #ffc107;
            --priority-low: #28a745;
        }

        body {
            background-color: var(--theme-color-light);
        }

        .navbar {
            background-color: var(--theme-color);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: bold;
            color: #333 !important;
        }

        .task-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: transform 0.2s;
        }

        .task-card:hover {
            transform: translateY(-2px);
        }

        .task-card .card-header {
            background-color: var(--theme-color);
            border-radius: 8px 8px 0 0;
        }

        .priority-badge {
            padding: 4px 8px;
            border-radius: 4px;
            color: white;
            font-size: 0.8em;
        }

        .priority-high {
            background-color: var(--priority-high);
        }

        .priority-medium {
            background-color: var(--priority-medium);
        }

        .priority-low {
            background-color: var(--priority-low);
        }

        .status-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8em;
        }

        .status-pending {
            background-color: #f8f9fa;
            color: #6c757d;
        }

        .status-in-progress {
            background-color: #cff4fc;
            color: #055160;
        }

        .status-completed {
            background-color: #d1e7dd;
            color: #0f5132;
        }

        .modal-content {
            border-radius: 8px;
        }

        .modal-header {
            background-color: var(--theme-color);
            border-radius: 8px 8px 0 0;
        }

        .btn-primary {
            background-color: var(--theme-color-dark);
            border-color: var(--theme-color-dark);
            color: #333;
        }

        .btn-primary:hover {
            background-color: var(--theme-color);
            border-color: var(--theme-color);
            color: #333;
        }

        #taskForm {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-control:focus {
            border-color: var(--theme-color);
            box-shadow: 0 0 0 0.2rem rgba(250, 218, 221, 0.25);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .task-card {
                margin-bottom: 15px;
            }

            .filters {
                margin-top: 10px;
            }
        }

        /* Animation for status changes */
        .task-card {
            transition: all 0.3s ease;
        }

        /* User Management Table Styles */
        .table {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .table thead {
            background-color: var(--theme-color);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--theme-color-light);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--theme-color);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--theme-color-dark);
        }
    </style>
</head>

<body>

<!-- Navbar -->
<nav class="navbar mb-4">
  <div class="container d-flex justify-content-between align-items-center">
    <a class="navbar-brand" href="#">Task Manager</a>
    <div>
      <button id="loginBtn" class="btn btn-outline-primary">Login</button>
      <button id="logoutBtn" class="btn btn-outline-danger" style="display:none;">Logout</button>
    </div>
  </div>
</nav>

<div class="container">
    <div id="userInfo" class="mb-3 fs-5 fw-semibold"></div>

    <!-- Status Filter -->
    <div class="filters mb-3">
        <select id="statusFilter" class="form-select w-auto">
            <option value="">All Statuses</option>
            <option value="pending">Pending</option>
            <option value="in-progress">In Progress</option>
            <option value="completed">Completed</option>
        </select>
    </div>

    <!-- Task List -->
    <div id="taskCards" class="row"></div>

    <!-- Create Task Form -->
    <form id="createTaskForm" class="mt-4">
        <h4>Create Task</h4>
        <div class="mb-3">
            <input type="text" id="taskTitle" class="form-control" placeholder="Title" required />
        </div>
        <div class="mb-3">
            <textarea id="taskDescription" class="form-control" placeholder="Description" required></textarea>
        </div>
        <div class="mb-3">
            <select id="assignedUser" class="form-select" required>
                <option value="">Assign To</option>
                <!-- Options populated by JS -->
            </select>
        </div>

        <div class="mb-3">
            <select id="taskCategory" class="form-select" required>
                <option value="development">Development</option>
                <option value="design">Design</option>
                <option value="testing">Testing</option>
                <option value="deployment">Deployment</option>
            </select>
        </div>
        <div class="mb-3">
            <select id="taskPriority" class="form-select" required>
                <option value="high">High</option>
                <option value="medium" selected>Medium</option>
                <option value="low">Low</option>
            </select>
            </div>
            <div class="mb-3">
                <input type="date" id="taskDeadline" class="form-control" required />
            </div>
            <button type="submit" class="btn btn-primary">Create Task</button>
        </form>
    </div>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="loginForm" class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="loginModalLabel">Login</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="email" id="email" class="form-control mb-3" placeholder="Email" required />
            <input type="password" id="password" class="form-control" placeholder="Password" required />
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
        </form>
    </div>
    </div>

    <!-- Bootstrap JS Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Your JavaScript code

    const mockUsers = [
        { id: 1, name: 'Admin User', email: 'admin@example.com', role: 'admin', password: 'admin123' },
        { id: 2, name: 'Team Member', email: 'team@example.com', role: 'member', password: 'team123' },
        { id: 3, name: 'Guest User', email: 'guest@example.com', role: 'guest', password: 'guest123' }
    ];

    let currentUser = null;
    let tasks = [];

    // DOM Elements
    const loginBtn = document.getElementById('loginBtn');
    const logoutBtn = document.getElementById('logoutBtn');
    const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
    const loginForm = document.getElementById('loginForm');
    const userInfo = document.getElementById('userInfo');
    const taskList = document.getElementById('taskCards');
    const createTaskForm = document.getElementById('createTaskForm');
    const statusFilter = document.getElementById('statusFilter');

    // Event Listeners
    loginBtn.addEventListener('click', () => loginModal.show());
    logoutBtn.addEventListener('click', handleLogout);
    loginForm.addEventListener('submit', handleLogin);
    createTaskForm.addEventListener('submit', handleCreateTask);
    statusFilter.addEventListener('change', filterTasks);

    // Login Handler
    function handleLogin(e) {
        e.preventDefault();
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        const user = mockUsers.find(u => u.email === email && u.password === password);

        if (user) {
            currentUser = user;
            updateUIForRole(user.role);
            loginModal.hide();
            showNotification('Login successful!', 'success');
        } else {
            showNotification('Invalid credentials!', 'error');
        }
    }

    // Logout Handler
    function handleLogout() {
        currentUser = null;
        updateUIForRole(null);
        showNotification('Logged out successfully!', 'success');
    }

    // Update UI based on user role
    function updateUIForRole(role) {
        const adminElements = document.querySelectorAll('.admin-only');
        const memberElements = document.querySelectorAll('.member-only');

        if (role === 'admin') {
            adminElements.forEach(el => el.style.display = 'block');
            memberElements.forEach(el => el.style.display = 'block');
            loginBtn.style.display = 'none';
            logoutBtn.style.display = 'block';
            userInfo.textContent = `Welcome, Admin!`;
        } else if (role === 'member') {
            adminElements.forEach(el => el.style.display = 'none');
            memberElements.forEach(el => el.style.display = 'block');
            loginBtn.style.display = 'none';
            logoutBtn.style.display = 'block';
            userInfo.textContent = `Welcome, Team Member!`;
        } else if (role === 'guest') {
            adminElements.forEach(el => el.style.display = 'none');
            memberElements.forEach(el => el.style.display = 'none');
            loginBtn.style.display = 'none';
            logoutBtn.style.display = 'block';
            userInfo.textContent = `Welcome, Guest!`;
        } else {
            adminElements.forEach(el => el.style.display = 'none');
            memberElements.forEach(el => el.style.display = 'none');
            loginBtn.style.display = 'block';
            logoutBtn.style.display = 'none';
            userInfo.textContent = '';
        }

        refreshTaskList();
    }

    // Create Task Handler
    function handleCreateTask(e) {
        e.preventDefault();

        if(!currentUser) {
            showNotification('Please login to create tasks.', 'error');
            return;
        }

        const newTask = {
            id: Date.now(),
            title: document.getElementById('taskTitle').value,
            description: document.getElementById('taskDescription').value,
            assignedTo: document.getElementById('assignedUser').value,
            category: document.getElementById('taskCategory').value,
            priority: document.getElementById('taskPriority').value,
            deadline: document.getElementById('taskDeadline').value,
            status: 'pending',
            createdBy: currentUser.id,
            createdAt: new Date().toISOString()
        };

        tasks.push(newTask);
        createTaskForm.reset();
        refreshTaskList();
        showNotification('Task created successfully!', 'success');

        // Mock email notification
        if (newTask.assignedTo) {
            sendEmailNotification(newTask);
        }
    }

    // Refresh Task List
    function refreshTaskList() {
        const filteredTasks = filterTasks();
        taskList.innerHTML = '';

        filteredTasks.forEach(task => {
            const taskCard = createTaskCard(task);
            taskList.appendChild(taskCard);
        });
    }

    // Create Task Card
    function createTaskCard(task) {
        const div = document.createElement('div');
        div.className = 'col-md-4';
        div.innerHTML = `
            <div class="task-card card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">${task.title}</h5>
                    <span class="priority-badge priority-${task.priority}">${task.priority}</span>
                </div>
                <div class="card-body">
                    <p class="card-text">${task.description}</p>
                    <div class="task-details">
                        <p><strong>Category:</strong> ${task.category}</p>
                        <p><strong>Deadline:</strong> ${new Date(task.deadline).toLocaleDateString()}</p>
                        <p><strong>Assigned to:</strong> ${task.assignedTo}</p>
                        <span class="status-badge status-${task.status}">${task.status}</span>
                    </div>
                    ${currentUser && (currentUser.role === 'admin' || currentUser.id === task.createdBy) ? `
                        <div class="task-actions mt-3">
                            <button class="btn btn-sm btn-primary" onclick="editTask(${task.id})">Edit</button>
                            <button class="btn btn-sm btn-danger" onclick="deleteTask(${task.id})">Delete</button>
                            <select class="form-select form-select-sm mt-2" onchange="updateTaskStatus(${task.id}, this.value)">
                                <option value="pending" ${task.status === 'pending' ? 'selected' : ''}>Pending</option>
                                <option value="in-progress" ${task.status === 'in-progress' ? 'selected' : ''}>In Progress</option>
                                <option value="completed" ${task.status === 'completed' ? 'selected' : ''}>Completed</option>
                            </select>
                        </div>
                    ` : ''}
                </div>
            </div>
        `;
        return div;
    }

    // Filter Tasks
    function filterTasks() {
        const status = statusFilter.value;
        const filtered = status ? tasks.filter(task => task.status === status) : tasks;
        return filtered;
    }

    // Update Task Status
    function updateTaskStatus(taskId, newStatus) {
        const task = tasks.find(t => t.id === taskId);
        if (task) {
            task.status = newStatus;
            refreshTaskList();
            showNotification('Task status updated!', 'success');
        }
    }

    // Delete Task
    function deleteTask(taskId) {
        if (confirm('Are you sure you want to delete this task?')) {
            tasks = tasks.filter(t => t.id !== taskId);
            refreshTaskList();
            showNotification('Task deleted successfully!', 'success');
        }
    }

    // Edit Task
    function editTask(taskId) {
        const task = tasks.find(t => t.id === taskId);
        if (task) {
            document.getElementById('taskTitle').value = task.title;
            document.getElementById('taskDescription').value = task.description;
            document.getElementById('assignedUser').value = task.assignedTo;
            document.getElementById('taskCategory').value = task.category;
            document.getElementById('taskPriority').value = task.priority;
            document.getElementById('taskDeadline').value = task.deadline;

            // Remove the old task and submit the form to create an updated version
            tasks = tasks.filter(t => t.id !== taskId);
            showNotification('Task opened for editing', 'info');
        }
    }

    // Mock Email Notification
    function sendEmailNotification(task) {
        console.log(`Email notification sent for task: ${task.title}`);
        // In a real application, this would integrate with an email service
    }

    // Notification System
    function showNotification(message, type) {
        // You could use a library like toastr or create a custom notification system
        alert(message);
    }

    // Initialize the application
    function initializeApp() {
        // Populate user dropdown for task assignment
        const assignedUserSelect = document.getElementById('assignedUser');
        assignedUserSelect.innerHTML = '<option value="">Assign To</option>';
        mockUsers.forEach(user => {
            const option = document.createElement('option');
            option.value = user.name;
            option.textContent = user.name;
            assignedUserSelect.appendChild(option);
        });

        // Add some sample tasks
        tasks = [
            {
                id: 1,
                title: 'Sample Task',
                description: 'This is a sample task to demonstrate the functionality.',
                assignedTo: 'Team Member',
                category: 'development',
                priority: 'medium',
                deadline: '2024-12-31',
                status: 'pending',
                createdBy: 1,
                createdAt: new Date().toISOString()
            }
        ];

        refreshTaskList();
    }

    // Initialize the application when the DOM is loaded
    document.addEventListener('DOMContentLoaded', initializeApp);
</script>

</body>
</html>





