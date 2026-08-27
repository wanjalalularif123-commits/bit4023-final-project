# BIT4023 Final Project — Course Registration System

A web application for course registration, built with HTML, CSS, Vanilla JavaScript, and PHP + MySQL. Users register as either a **Student** or a **Lecturer**, with different dashboard views for each role.

## Features
- Account registration and login (email + password, hashed with `password_hash()`)
- Role-based access: **Lecturers** create/edit/delete courses; **Students** browse and select/drop courses
- Seat tracking — seats decrease when a student selects a course, and restore when they drop it
- Session-based authentication with protected pages
- Responsive, styled UI (green theme, card layouts, styled tables)

## Team Roles & File Ownership

| Member | Role | Files |
|---|---|---|
| 1 | UI/Frontend | `index.html`, `css/style.css`, `includes/header.php`, `includes/footer.php` |
| 2 | JavaScript | `js/validation.js`, `js/ui.js` |
| 3 | PHP Auth & Sessions | `config.php`, `php/db.php`, `php/session.php`, `register.php`, `login.php`, `logout.php`, `dashboard.php` |
| 4 | Application Module (Course CRUD + Enrollment) | `includes/module.php`, `module_create.php`, `module_edit.php`, `module_delete.php`, `module_enroll.php`, `module_drop.php`, `courses`/`enrollments` tables in `sql/database.sql` |
| 5 | Integration, QA & Docs | `README.md`, `.gitignore`, overall repo structure, end-to-end testing |

## Setup (every team member, before writing code)
1. Install XAMPP (or MAMP).
2. Clone this repo into `htdocs`, named exactly `bit4023-final-project`.
3. Start Apache + MySQL in the XAMPP control panel.
4. Import `sql/database.sql` via phpMyAdmin (drop any old `users`/`courses`/`items`/`enrollments` tables first if re-importing after a schema change).
5. Update `php/db.php` and `config.php` if your local MySQL username/password differs from the XAMPP defaults (`root`, no password).
6. Visit `http://localhost/bit4023-final-project/index.html` to confirm it loads styled correctly.

## File Structure
```
/bit4023-final-project
  /css/style.css
  /js/validation.js
  /js/ui.js
  /php/db.php
  /php/session.php
  /includes/header.php
  /includes/footer.php
  /includes/module.php
  /sql/database.sql
  config.php
  index.html
  register.php
  login.php
  dashboard.php
  logout.php
  module_create.php
  module_edit.php
  module_delete.php
  module_enroll.php
  module_drop.php
```

## Database Schema
- **`users`** — `id`, `full_name`, `email` (unique), `password_hash`, `role` (`student` or `lecturer`), `created_at`
- **`courses`** — `id`, `course_code`, `course_name`, `schedule`, `seats_available`, `created_at`
- **`enrollments`** — `id`, `user_id`, `course_id`, `enrolled_at` (unique per user+course, cascades on delete)

## How Auth + CRUD Connect
`register.php`/`login.php`/`dashboard.php`/`logout.php` use `config.php` for the session and PDO connection. `dashboard.php` additionally requires `php/db.php` (mysqli) so `includes/module.php` and the `module_*.php` files can run the course/enrollment queries. `includes/module.php` checks `$_SESSION['role']` to decide whether to show the lecturer's course-management view or the student's enroll/drop view.

## Status
- [x] UI pages complete
- [x] JS validation complete
- [x] Auth (register/login/session, with role selection) complete
- [x] Application module + CRUD complete (course management + student enrollment)
- [ ] Final full-team integration test before submission
