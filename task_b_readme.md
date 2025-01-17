
# Laravel RBAC (Role-Based Access Control) Project

This README outlines the setup and functionality of a Laravel 10 project implementing Role-Based Access Control (RBAC) for a company with three user roles: Admin, Manager, and Employee.

---

## Prerequisites

- PHP >= 8.1
- Composer
- Laravel 10
- MySQL

---

## Installation Instructions

### 1. Clone the Repository
```bash
git clone <https://github.com/yakubu234/snapnet.git>
cd </snapnet/task_b_laravel>
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Environment Setup
- Copy the `.env.example` file to `.env`:
```bash
cp .env.example .env
```
- Update the following in the `.env` file:
  - **Database Configuration**:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_user
    DB_PASSWORD=your_database_password
    ```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Run Migrations
```bash
php artisan migrate
```

### 6. Seed Initial Roles
Run the database seeder to create default roles (Admin, Manager, Employee):
```bash
php artisan db:seed --class=RoleSeeder
```
---

## Testing

### Running Tests
- **Unit and Feature Tests**:
  - Tests validate role-based access control and endpoint functionality.
- Run the tests:
```bash
php artisan test
```

---

## Additional Notes

### Middleware Configuration
- The middleware ensures only users with the required roles can access specific endpoints. Middleware checks are applied globally or to individual routes as needed.

## License
This project is licensed under the MIT License.

---

## Contact
For any issues or support, contact [yakubu.abiola@yahoo.com].
