# BlogAPI - Laravel API for Blog Posts

This repository contains a simple Laravel API for managing blog posts. It provides basic CRUD operations for creating, reading, updating, and deleting posts with basic validation, authentication, and scheduling of tasks.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

* PHP 8.3
* Composer
* MySQL or MariaDB

### More info
* The project was developed on an linux based machine. (Ubuntu 22.04)

### Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/LowUp/BlogAPI.git
2. **Navigate to the project directory:**
``cd BlogAPI``
3. **Install dependencies:**
    ```bash
    composer install
4. **Copy the .env.example file to .env and configure your database credentials:**
    ```bash
    cp .env.example .env
5. **Create the database:**
    ```bash
    php artisan migrate
6. **Start the development server:**
    ````bash
    php artisan serve
7. **Project Url**
    ````bash
    http://127.0.0.1:8000
8. **Test API with Swagger:**
    ````bash
    curl http://127.0.0.1:8000/api/documentation
### Running projects
1. **Run the tests:**
    ````bash
    php artisan test
## API Endpoints
### The API provides the following endpoints:
* GET /api/posts: Retrieve a list of all posts.
* GET /api/posts/{id}: Retrieve a specific post by its ID.
* POST /api/posts: Create a new post.
* PUT /api/posts/{id}: Update an existing post.
* DELETE /api/posts/{id}: Delete a post.

### Authentication:
#### Example Request (using curl):
    ```bash
    curl --location '127.0.0.1:8001/api/posts' \
    --header 'Content-Type: application/json' \
    --header 'Authorization: Basic dGVzdDp0ZXN0' \
    --data '{
        "title": "Title 1",
        "content": "content 1",
        "author": "author 1"
    }'
### Test scheduling:
* I set the background job to ``everyMinute()``

```bash
    php artisan schedule:work	