{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PinkTask - Task Manager</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --pink-light: #FADADD;
            --pink-medium: #F8C8CC;
            --pink-dark: #F6B6C0;
            --priority-high: #dc3545;
            --priority-medium: #ffc107;
            --priority-low: #28a745;
        }

        body {
            background-color: var(--pink-light);
            font-family: 'Arial', sans-serif;
        }

        /* Login Page Styles */
        .login-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            max-width: 400px;
            margin: 50px auto;
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .login-header h1 {
            color: var(--pink-dark);
            font-weight: bold;
            margin-bottom: 10px;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
        }

        .form-control:focus {
            border-color: var(--pink-medium);
            box-shadow: 0 0 0 0.2rem rgba(248, 200, 204, 0.25);
        }

        .login-btn {
            background-color: var(--pink-dark);
            border: none;
            border-radius: 8px;
            padding: 12px;
            width: 100%;
            color: white;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .login-btn:hover {
            background-color: var(--pink-medium);
        }

        .demo-accounts {
            margin-top: 20px;
            font-size: 0.9em;
            color: #666;
            border-top: 1px solid #eee;
            padding-top: 15px;
        }

        /* App Page Styles */
        .navbar {
            background-color: var(--pink-medium);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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

        /* Hide/Show Sections */
        #loginPage {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        #appPage {
            display: none;
        }
    </style>
</head>
<body>
    <!-- Login Page -->
    <div id="loginPage">
        <div class="login-container">
            <div class="login-header">
                <h1>PinkTask</h1>
                <p>Task Management System</p>
            </div>

            <form id="loginForm">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Enter your username" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter your password" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Login As</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role" id="adminRole" value="admin">
                        <label class="form-check-label" for="adminRole">Admin</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role" id="memberRole" value="member" checked>
                        <label class="form-check-label" for="memberRole">Team Member</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role" id="guestRole" value="guest">
                        <label class="form-check-label" for="guestRole">Guest</label>
                    </div>
                </div>

                <button type="submit" class="btn login-btn">Sign In</button>

                <div class="demo-accounts">
                    <p>Demo accounts:</p>
                    <p>Admin: admin/admin</p>
                    <p>Team Member: member/member</p>
                    <p>Guest: guest/guest</p>
                </div>
            </form>
        </div>
    </div>

    <!-- App Page -->
    <div id="appPage">
        <!-- Navbar -->
        <nav class="navbar mb-4">
            <div class="container d-flex justify-content-between align-items-center">
                <a class="navbar-brand" href="#">PinkTask</a>
                <div>
                    <span id="userGreeting" class="me-3"></span>
                    <button id="logoutBtn" class="btn btn-outline-danger">Logout</button>
                </div>
            </div>
        </nav>

        <div class="container">
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
                    <input type="text" id="taskTitle" class="form-control" placeholder="Title" required>
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
                    <input type="date" id="taskDeadline" class="form-control" required>
                </div>
                <button type="submit" class="btn" style="background-color: var(--pink-dark); color: white;">Create Task</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Mock Users Data
        const mockUsers = [
            { id: 1, name: 'Admin User', username: 'admin', password: 'admin', role: 'admin' },
            { id: 2, name: 'Team Member', username: 'member', password: 'member', role: 'member' },
            { id: 3, name: 'Guest User', username: 'guest', password: 'guest', role: 'guest' }
        ];

        // Mock Tasks Data
        let tasks = [
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

        // Current User
        let currentUser = null;

        // DOM Elements
        const loginPage = document.getElementById('loginPage');
        const appPage = document.getElementById('appPage');
        const loginForm = document.getElementById('loginForm');
        const logoutBtn = document.getElementById('logoutBtn');
        const userGreeting = document.getElementById('userGreeting');
        const taskCards = document.getElementById('taskCards');
        const createTaskForm = document.getElementById('createTaskForm');
        const statusFilter = document.getElementById('statusFilter');
        const assignedUserSelect = document.getElementById('assignedUser');

        // Initialize the app
        function initApp() {
            // Check if user is logged in (simple session for demo)
            const loggedInUser = sessionStorage.getItem('currentUser');
            if (loggedInUser) {
                currentUser = JSON.parse(loggedInUser);
                showAppPage();
            } else {
                showLoginPage();
            }

            // Set up event listeners
            setupEventListeners();
        }

        // Show login page
        function showLoginPage() {
            loginPage.style.display = 'flex';
            appPage.style.display = 'none';
        }

        // Show app page
        function showAppPage() {
            loginPage.style.display = 'none';
            appPage.style.display = 'block';

            // Update UI
            userGreeting.textContent = `Welcome, ${currentUser.name}!`;
            refreshTaskList();
            populateUserDropdown();
        }

        // Set up event listeners
        function setupEventListeners() {
            // Login form submission
            loginForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const username = document.getElementById('username').value;
                const password = document.getElementById('password').value;
                const role = document.querySelector('input[name="role"]:checked').value;

                // Find user
                const user = mockUsers.find(u =>
                    u.username === username &&
                    u.password === password &&
                    u.role === role
                );

                if (user) {
                    currentUser = user;
                    sessionStorage.setItem('currentUser', JSON.stringify(user));
                    showAppPage();
                    alert('Login successful!');
                } else {
                    alert('Invalid credentials or role selection!');
                }
            });

            // Logout button
            logoutBtn.addEventListener('click', function() {
                sessionStorage.removeItem('currentUser');
                currentUser = null;
                showLoginPage();
                loginForm.reset();
            });

            // Create task form
            createTaskForm.addEventListener('submit', function(e) {
                e.preventDefault();

                if (!currentUser) {
                    alert('Please login to create tasks.');
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
                alert('Task created successfully!');
            });

            // Status filter
            statusFilter.addEventListener('change', refreshTaskList);
        }

        // Refresh task list
        function refreshTaskList() {
            const status = statusFilter.value;
            const filteredTasks = status ? tasks.filter(task => task.status === status) : tasks;

            taskCards.innerHTML = '';

            filteredTasks.forEach(task => {
                const taskCard = document.createElement('div');
                taskCard.className = 'col-md-4 mb-3';
                taskCard.innerHTML = `
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
                                <span class="status-badge status-${task.status}">${task.status.replace('-', ' ')}</span>
                            </div>
                            ${currentUser && (currentUser.role === 'admin' || currentUser.id === task.createdBy) ? `
                                <div class="task-actions mt-3">
                                    <button class="btn btn-sm btn-primary me-2" onclick="editTask(${task.id})">Edit</button>
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
                taskCards.appendChild(taskCard);
            });
        }

        // Populate user dropdown
        function populateUserDropdown() {
            assignedUserSelect.innerHTML = '<option value="">Assign To</option>';
            mockUsers.forEach(user => {
                if (user.role !== 'guest') { // Don't assign tasks to guests
                    const option = document.createElement('option');
                    option.value = user.name;
                    option.textContent = user.name;
                    assignedUserSelect.appendChild(option);
                }
            });
        }

        // Task functions (needed for inline event handlers)
        window.editTask = function(taskId) {
            const task = tasks.find(t => t.id === taskId);
            if (task) {
                document.getElementById('taskTitle').value = task.title;
                document.getElementById('taskDescription').value = task.description;
                document.getElementById('assignedUser').value = task.assignedTo;
                document.getElementById('taskCategory').value = task.category;
                document.getElementById('taskPriority').value = task.priority;
                document.getElementById('taskDeadline').value = task.deadline;

                // Remove the old task
                tasks = tasks.filter(t => t.id !== taskId);
                alert('Task opened for editing');
            }
        };

        window.deleteTask = function(taskId) {
            if (confirm('Are you sure you want to delete this task?')) {
                tasks = tasks.filter(t => t.id !== taskId);
                refreshTaskList();
                alert('Task deleted successfully!');
            }
        };

        window.updateTaskStatus = function(taskId, newStatus) {
            const task = tasks.find(t => t.id === taskId);
            if (task) {
                task.status = newStatus;
                refreshTaskList();
            }
        };

        // Initialize the app when the page loads
        document.addEventListener('DOMContentLoaded', initApp);
    </script>
</body>
</html> --}}
