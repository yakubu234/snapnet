# Laravel CRUD Application with Relationships

This document outlines the steps to set up and run the Laravel application for managing company projects and employees. The application includes features such as CRUD operations, relationships, authentication, authorization, and reporting.

---

## Prerequisites

- PHP >= 8.1
- Composer
- Laravel 10
- MySQL
- Mail server configuration (for email notifications)

---

## Installation Instructions

### 1. Clone the Repository
```bash
git clone <https://github.com/yakubu234/snapnet.git>
cd </snapnet/task_a_laravel>
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
    QUEUE_CONNECTION=database / redis

    ```
  - **Mail Configuration** (for email notifications):
    ```env
    MAIL_MAILER=smtp
    MAIL_HOST=your_mail_host
    MAIL_PORT=your_mail_port
    MAIL_USERNAME=your_mail_username
    MAIL_PASSWORD=your_mail_password
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS=your_email@example.com
    MAIL_FROM_NAME="Your Application Name"
    ```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Run Migrations
```bash
php artisan migrate
```

### 6. Seed the Database (Optional)
To populate the database with sample data:
```bash
php artisan db:seed
```

### 7. Start the Development Server
```bash
php artisan serve
```

### 8. Start the queue worker
```bash
php artisan queue:work
```
The application will be accessible at `http://localhost:8000`.

---

## API Endpoints

### Authentication
- **Register**: `POST /api/register`
- **Login**: `POST /api/login`
- **Logout**: `GET /api/logout`

### Projects
- **List Projects**: `GET /api/projects`
- **List Single Project**: `GET /api/projects/{id}`
- **Create Project**: `POST /api/projects`
- **Search/Filter Project**: `GET /api/projects?status=pending&name=any_name_is_fine.`
- **Update Project**: `PUT /api/projects/{id}`
- **Delete Project**: `DELETE /api/projects/{id}`

### Employees
- **List Employees for a Project**: `GET /api/projects/{project_id}/employees`
- **Add Employee to a Project**: `POST /api/projects/{project_id}/employees`
- **View Employee**: `GET /api/projects/{project_id}/employees/{id}`
- **Update Employee**: `PUT /api/projects/{project_id}/employees/{id}`
- **Delete Employee**: `DELETE /api/projects/{project_id}/employees/{id}`
- **Restore Soft-Deleted Employee**: `POST /api/employees/{id}/restore`

### Dashboard
- **Dashboard endpoint to return summary of project**: `GET /api/dashboard`

---

## Features

### Relationships
- **One-to-Many**: Projects can have multiple employees.

### Soft Deletes
- Both Projects and Employees support soft delete functionality.

### Validation
- Project name is required and unique.
- Employee email must be valid and unique.

### Reporting
- Dashboard endpoint provides a summary of projects and employees.
- Search and filter projects by name or status.

### Email Notifications
- Sends a welcome email to an employee when added to a project.
- Utilizes Laravel Queues for asynchronous email processing.

---

## Testing

### Running Tests
- test still pending.
---

## License
This project is licensed under the MIT License.

---

## Contact
For any issues or support, contact [yakubu.abiola@yahoo.com].
