# Paymon Academy Management System

Academy management system for handle courses, students, and payments.

## Technologies

- PHP 8.2
- Laravel 12.0
- Laravel Breeze
- Livewire 3.4
- Volt 1.7
- MySQL/SQLite
- TailwindCSS

## Prerequisites

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL or SQLite

## Installation

1. Clone the repository
```bash
git clone https://github.com/lcubas/paymon-challenge.git
cd paymon-challenge
```
2. Install PHP dependencies
```bash
composer install
 ```

3. Install JavaScript dependencies
```bash
npm install
 ```

4. Configure environment
```bash
cp .env.example .env
php artisan key:generate
 ```

5. Configure your database in .env file
```plaintext
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=paymon
DB_USERNAME=root
DB_PASSWORD=
 ```

6. Run migrations
```bash
php artisan migrate
 ```

7. Seed database with sample data
```bash
php artisan db:seed
 ```

8. Build assets
```bash
npm run build
 ```

## Running the Application
You can run the application using the custom dev command which starts all necessary services:

```bash
composer run dev
 ```

This command will concurrently run:

- Laravel development server
- Queue worker
- Log viewer
- Vite development server
Alternatively, you can run services individually:

```bash
php artisan serve
npm run dev
 ```

## API Examples
### 1. Authentication
```bash
POST /api/login
Content-Type: application/json

{
    "email": "user@example.com",
    "password": "password"
}

Response:
{
    "data": {
        "token": "your-api-token",
        "user": {
            "id": 1,
            "email": "user@example.com",
            ...
        }
    },
    "message": "Login successful"
}
```

### 2. Enroll Student in a Course
```bash
POST /api/enrollments
Content-Type: application/json

{
    "student_id": 1,
    "course_id": 1,
    "payment": {
        "amount": 999.99,
        "payment_method": "credit_card"
    }
}
 ```

### 3. Create a New Enrollment
```bash
POST /api/enrollments
Authorization: Bearer your-api-token
Content-Type: application/json

{
    "course_id": 1,
    "student_first_name": "John",
    "student_last_name": "Doe",
    "student_birth_date": "2000-01-01"
}
```

### 4. Process Payment
```bash
POST /api/payments
Authorization: Bearer your-api-token
Content-Type: application/json

{
    "enrollment_id": 1,
    "amount": 999.99,
    "payment_method": "cash"  // cash, transfer
}
```

## Features
- Academy Management
- Course Administration
- Student Enrollment
- Payment Processing
- Legal Guardian Management
- Communication System
- Enrollment Tracking
## Testing
Run the test suite using PEST:

```bash
php artisan test
 ```

## License
This project is open-sourced software licensed under the MIT license .
