<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PinkTask Dashboard</title>
    <style>
        :root {
            --pink-light: #FADADD;
            --pink-medium: #F8C8CC;
            --pink-dark: #F6B6C0;
            --priority-high: #FF6B6B;
            --priority-medium: #FFD166;
            --priority-low: #06D6A0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }

        h1, h2, h3, h4, h5, h6 {
            color: var(--pink-dark);
            margin-top: 0;
        }

        .dashboard-header {
            margin-bottom: 30px;
        }

        .filter-section {
            margin-bottom: 30px;
        }

        .filter-group {
            margin-bottom: 15px;
        }

        .filter-group h4 {
            margin-bottom: 10px;
        }

        .filter-options {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .filter-option {
            padding: 5px 15px;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .filter-option:hover {
            background-color: var(--pink-light);
        }

        .filter-option.active {
            background-color: var(--pink-medium);
            border-color: var(--pink-medium);
            font-weight: 500;
        }

        .task-list {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .task-group {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .task-group-header {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .task-group-title {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .task-item {
            background-color: white;
            border-left: 4px solid var(--pink-medium);
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .task-item.high-priority {
            border-left-color: var(--priority-high);
        }

        .task-title {
            font-weight: 600;
            margin-bottom: 8px;
        }

        .task-description {
            color: #666;
            margin-bottom: 12px;
        }

        .task-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            font-size: 0.9rem;
        }

        .task-meta-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .priority-indicator {
            display: inline-flex;
            align-items: center;
            gap: 3px;
            font-weight: 500;
        }

        .priority-high {
            color: var(--priority-high);
        }

        .priority-medium {
            color: var(--priority-medium);
        }

        .priority-low {
            color: var(--priority-low);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .user-avatar {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: var(--pink-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            font-weight: bold;
        }

        .category-tag {
            padding: 2px 8px;
            background-color: var(--pink-light);
            border-radius: 10px;
            font-size: 0.8rem;
        }

        hr {
            border: none;
            border-top: 1px solid #eee;
            margin: 30px 0;
        }
    </style>
</head>
<body>
    <div class="dashboard-header">
        <h1>PinkTask</h1>
        <h2>Task Dashboard</h2>
        <p>Manage and track your team's tasks</p>
    </div>

    <div class="filter-section">
        <div class="filter-group">
            <h4>Filter by Status</h4>
            <div class="filter-options">
                <div class="filter-option active">All Statuses</div>
                <div class="filter-option">Pending</div>
                <div class="filter-option">In Progress</div>
                <div class="filter-option">Completed</div>
            </div>
        </div>

        <div class="filter-group">
            <h4>Filter by Category</h4>
            <div class="filter-options">
                <div class="filter-option active">All Categories</div>
                <div class="filter-option">Design</div>
                <div class="filter-option">Development</div>
                <div class="filter-option">Testing</div>
            </div>
        </div>

        <div class="filter-group">
            <h4>Filter by Priority</h4>
            <div class="filter-options">
                <div class="filter-option active">All Priorities</div>
                <div class="filter-option">High</div>
                <div class="filter-option">Medium</div>
                <div class="filter-option">Low</div>
            </div>
        </div>

        <div class="filter-group">
            <h4>Assigned To</h4>
            <div class="filter-options">
                <div class="filter-option active">All Users</div>
                <div class="filter-option">Sarah Smith</div>
                <div class="filter-option">John Doe</div>
                <div class="filter-option">Mike Johnson</div>
            </div>
        </div>
    </div>

    <hr>

    <div class="task-list">
        <h3>Tasks</h3>

        <!-- In Progress Tasks -->
        <div class="task-group">
            <div class="task-group-header">
                <h4 class="task-group-title">1. In Progress</h4>
                <span class="priority-indicator priority-high">High</span>
            </div>

            <div class="task-item high-priority">
                <h5 class="task-title">Design new landing page</h5>
                <p class="task-description">Create a modern and responsive landing page design for the new product launch.</p>
                <div class="task-meta">
                    <div class="task-meta-item">
                        <div class="user-info">
                            <span class="user-avatar">SS</span>
                            <span>Sarah Smith</span>
                        </div>
                    </div>
                    <div class="task-meta-item">
                        <span class="category-tag">Design</span>
                    </div>
                    <div class="task-meta-item">
                        <span>Jul 15, 2023</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Tasks -->
        <div class="task-group">
            <div class="task-group-header">
                <h4 class="task-group-title">3. Pending</h4>
                <span class="priority-indicator priority-high">High</span>
            </div>

            <div class="task-item high-priority">
                <h5 class="task-title">Fix login authentication bug</h5>
                <p class="task-description">Users are experiencing issues with login authentication. Investigate and fix the bug.</p>
                <div class="task-meta">
                    <div class="task-meta-item">
                        <div class="user-info">
                            <span class="user-avatar">JD</span>
                            <span>John Doe</span>
                        </div>
                    </div>
                    <div class="task-meta-item">
                        <span class="category-tag">Development</span>
                    </div>
                    <div class="task-meta-item">
                        <span>Jul 10, 2023</span>
                    </div>
                </div>
            </div>

            <div class="task-group-header">
                <h4 class="task-group-title">5. Pending</h4>
                <span class="priority-indicator priority-medium">Medium</span>
            </div>

            <div class="task-item medium-priority">
                <h5 class="task-title">Write API documentation</h5>
                <p class="task-description">Create comprehensive documentation for the new API endpoints.</p>
                <div class="task-meta">
                    <div class="task-meta-item">
                        <div class="user-info">
                            <span class="user-avatar">MJ</span>
                            <span>Mike Johnson</span>
                        </div>
                    </div>
                    <div class="task-meta-item">
                        <span class="category-tag">Development</span>
                    </div>
                    <div class="task-meta-item">
                        <span>Jul 20, 2023</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Simple filter toggle functionality
        document.querySelectorAll('.filter-option').forEach(option => {
            option.addEventListener('click', function() {
                // Get the parent filter options group
                const parentGroup = this.parentElement;

                // Remove active class from all options in this group
                parentGroup.querySelectorAll('.filter-option').forEach(opt => {
                    opt.classList.remove('active');
                });

                // Add active class to clicked option
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>
