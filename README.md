This project is a Task Mangment built with Laravel 10 that provides a RESTful APIf for managing Tasks ,It allows users to perform CRUD operations (Create, Read, Update, Delete) on books with the ability to filter books by title or auth or description or published at  or category,or show the books that borrowed or not borrowed  , or apply both filtering and show available books.and allows user to perform CRUD on rating ,and the user can borrowed the book or return it by CRUD opeation on Borrow_Record. The project follows repository design patterns and incorporates clean code and refactoring principles.


Key Features:
CRUD Operations on user:(Create ,update,delete,show) the admin onle can do this operation.
CRUD operation on task: (create,update,delete,show)the admin & manager can do this operation but the manager can update & delete onle on the task that create it.
Filtering : filter the task by status & priority by use scop query.
use services for clean separation of concerns.
Form Requests: Validation is handled by custom form request classes.
event & listener: for dinamic update to due_date 
API Response Service: Unified responses for API endpoints.

Resources: API responses are formatted using Laravel resources for a consistent structure.

### Technologies Used:
- **Laravel 10**
- **PHP**
- **MySQL**
- **XAMPP** (for local development environment)
- **Composer** (PHP dependency manager)
- **Postman Collection**: Contains all API requests for easy testing and interaction with the API.


## Installation

### Prerequisites

Ensure you have the following installed on your machine:
- **XAMPP**: For running MySQL and Apache servers locally.
- **Composer**: For PHP dependency management.
- **PHP**: Required for running Laravel.
- **MySQL**: Database for the project
- **Postman**: Required for testing the requestes.

### Steps to Run the Project

1. Clone the Repository  
   ```bash
   git clone https://github.com/KhatoonBadrea/Task-Management-API
2. Navigate to the Project Directory
   ```bash
   cd books-library
3. Install Dependencies
   ```bash
   composer install
4. Create Environment File
   ```bash
   cp .env.example .env
   Update the .env file with your database configuration (MySQL credentials, database name, etc.).
5. Generate Application Key
    ```bash
    php artisan key:generate
6. Run Migrations
    ```bash
    php artisan migrate
7. Seed the Database
    ```bash
    php artisan db:seed
8. Run the Application
    ```bash
    php artisan serve
9. Interact with the API and test the various endpoints via Postman collection 
    Get the collection from here:https:https://documenter.getpostman.com/view/37831879/2sAXjSy8WQ