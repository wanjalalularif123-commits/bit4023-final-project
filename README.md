# BIT4023 Final Project

Web application built with HTML, CSS, Vanilla JavaScript, and PHP + MySQL.

## Team Roles & File Ownership

| Member | Role | Files |
|---|---|---|
| 1 | UI/Frontend | `index.html`, `css/style.css`, `includes/header.php`, `includes/footer.php`, `includes/register_form.php`, `includes/login_form.php` |
| 2 | JavaScript | `js/validation.js`, `js/ui.js` |
| 3 | PHP Auth & Sessions | `php/db.php`, `php/session.php`, `register.php`, `login.php`, `logout.php`, `dashboard.php` |
| 4 | Application Module (CRUD) | `includes/module.php`, `module_create.php`, `module_edit.php`, `module_delete.php`, `items` table in `sql/database.sql` |
| 5 | Integration, QA & Docs | `README.md`, `.gitignore`, overall repo structure |

## Setup (every team member, before writing code)
1. Install XAMPP (or MAMP).
2. Clone this repo into `htdocs`.
3. Start Apache + MySQL in the XAMPP control panel.
4. Import `sql/database.sql` via phpMyAdmin.
5. Update `php/db.php` if your local MySQL username/password differs from defaults.
6. Visit `http://localhost/final-project/index.html` to confirm it loads.

## File Structure
```
/final-project
  /css/style.css
  /js/validation.js
  /js/ui.js
  /php/db.php
  /php/session.php
  /includes/header.php
  /includes/footer.php
  /includes/register_form.php
  /includes/login_form.php
  /includes/module.php
  /sql/database.sql
  index.html
  register.php
  login.php
  dashboard.php
  logout.php
  module_create.php
  module_edit.php
  module_delete.php
```

## Why includes/?
Shared pages (register, login, dashboard) are split into a **logic file** (PHP processing, owned by Member 3) and a **markup file** in `includes/` (owned by Member 1) so two people are never editing the same file at once.

## Status
- [ ] UI pages complete
- [ ] JS validation complete
- [ ] Auth (register/login/session) complete
- [ ] Application module + CRUD complete
- [ ] Integration tested end-to-end
