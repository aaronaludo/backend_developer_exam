## Installation Guide

Follow these steps to set up and run the project after cloning from GitHub.

### 1. Clone the Repository
```bash
git clone git@github.com:aaronaludo/backend_developer_exam.git
cd backend_developer_exam
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
1. Open **XAMPP** and start **Apache** and **MySQL**.
2. Open your browser and go to **[http://localhost/phpmyadmin](http://localhost/phpmyadmin)**.
3. Click on **Databases** in the top menu.
4. Enter a name for your database (e.g., `your_database_name`).
5. Click **Create**.

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

### 8. Create a Storage Link
```bash
php artisan storage:link
```

### 9. Start Development Server
```bash
php artisan serve
```
Now, visit: **[http://127.0.0.1:8000](http://127.0.0.1:8000)**

---
