# Backend Task - Laravel API for Online Shop. DDD (Domain-Driven Design).

---

## Requirements
- Laravel 11
- PHP 8.3
- Composer 2.8.1
- MySQL 8.0

---

## Setup Instructions

To set up and run this project locally, follow the steps below:

1. Clone the repository:
    ```bash
    git clone https://github.com/VadimsGurinovics/lmt-backend-task-ddd.git
    ```

2. Navigate into the project directory:
    ```bash
    cd lmt-backend-task-ddd
    ```

3. Copy the example environment file and modify the `.env` file according to your setup:
    ```bash
    cp .env.example .env
    ```

4. Install dependencies via Composer:
    ```bash
    composer install
    ```

5. Generate an application key:
    ```bash
    php artisan key:generate
    ```

6. Set up your database and run migrations:
    ```bash
    php artisan migrate
    ```

---

## Postman Collection

For easier manual testing, a Postman collection has been included in the repository. 
You can import this collection into Postman and use it to test the available API endpoints.
Just want to mention that this Postman collection was created more for first Design without DDD(Domain-Driven Design).
```bash
LMT-task.postman_collection.json
```
