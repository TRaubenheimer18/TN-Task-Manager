# 🗂️ Laravel Task Manager

A role-based task management web app built with Laravel 12, Laravel Breeze, and Tailwind CSS. It supports Admin, Member, and Guest roles with distinct dashboards and task permissions.

---

##  Features

- **Authentication** via Laravel Breeze
- **Role-based dashboards** (Admin, Member, Guest)
- **Task management** (create, view, assign, edit, delete)
- **Task status tracking** (pending, in-progress, completed)
- Test email route (`/send-test-email`)
- Beautiful, responsive UI with Tailwind CSS

---

## Tech Stack

- **Backend**: Laravel 12
- **Frontend**: Blade + Tailwind CSS
- **Authentication**: Laravel Breeze
- **Database**: SQLite (local by default)
- **Other Tools**: Composer, NPM

---

## Dependencies Needed
- composer install
- npm install
- npm run dev

---

## Default Users for testing
The app uses a local SQLite database so please register if these test users are not available.

| Role   | Email                                         | Password |
| ------ | --------------------------------------------- | -------- |
| Admin  | [admin@example.com](mailto:admin@example.com) | password |
| Member | [member@example.com](mailto:member@example.com) | password |
| Guest | [guest@example.com](mailto:guest@example.com) | password |




## Run the application 
- php artisan serve
- php -S 127.0.0.1:8080 -t public (if the previous one does not work)

 --- 


