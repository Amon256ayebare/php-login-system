# Render-ready PHP + MySQL Starter (Bootstrap UI)

Files included:
- index.php, register.php, login.php, dashboard.php, logout.php
- config.php (uses environment variables DB_HOST, DB_NAME, DB_USER, DB_PASS or defaults)
- db.sql (create the users table)
- Dockerfile (PHP 8.2 + Apache)
- render.yaml (Render service config)
- README.md (this file)

### Quick steps to deploy on Render (recommended):
1. Create a MySQL database on db4free.net (or another MySQL provider).
   - DB Host: db4free.net
   - DB Name: amon
   - DB User: amon
   - DB Pass: 123
   (You can change these values when creating the DB; if you do, set the same values in Render environment variables.)

2. Import `db.sql` into your database (via phpMyAdmin on db4free.net).

3. Push this project to a GitHub repo.

4. On Render.com create a new **Web Service** and connect your GitHub repo.
   - Choose **Docker** environment (Render will build using Dockerfile).
   - After creation, set environment variables in Render service (optional but recommended):
     - DB_HOST (default: db4free.net)
     - DB_NAME (default: amon)
     - DB_USER (default: amon)
     - DB_PASS (default: 123)

5. Deploy — Render will build and publish your app at `https://your-service.onrender.com`.

### Notes & security
- db4free.net is **for testing only** and not suitable for production. Consider a production-grade DB (CleverCloud, PlanetScale, Amazon RDS, etc.).
- Passwords are hashed with `password_hash()` but this starter has minimal security hardening—use HTTPS, input validation, CSRF protection, and other best practices before production.
- If you want changes (extra pages, admin panel, password reset), tell me what to add and I'll update the project.
