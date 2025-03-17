# Laravel Project

## Installation Guide

Follow these steps to set up and run the project after cloning from GitHub.

### 1. Clone the Repository
```bash
git clone https://github.com/your-username/your-laravel-project.git
cd your-laravel-project
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Copy Environment File
```bash
cp .env.example .env
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Create a Database
1. Open your browser and go to **[http://localhost/phpmyadmin](http://localhost/phpmyadmin)**.
2. Click on **Databases** in the top menu.
3. Enter a name for your database (e.g., `your_database_name`).
4. Click **Create**.

### 6. Configure Database  
Edit the `.env` file and update the following database settings:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
```

### 7. Run Migrations and Seed Database
```bash
php artisan migrate:fresh --seed
```

### 8. Start Development Server
```bash
php artisan serve
```
Now, visit: **[http://127.0.0.1:8000](http://127.0.0.1:8000)**

---
