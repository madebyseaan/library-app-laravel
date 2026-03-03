# 📚 Library Management System

A simple Laravel application for managing a library's book collection and borrowing system. This application demonstrates the MVC (Model-View-Controller) architecture pattern in Laravel.

## Team Members

- **Roma, Sean Justin**
- **Labrador, Mariene**
- **Garcia, Sophia Christi**
- **Bermejo, Kate Nicole**
- **Andura, Carla**

## Features

- **Book Management**
  - Add new books to the library
  - View all books with search functionality
  - Edit book information
  - Delete books
  - Track total and available quantities

- **Borrowing System**
  - Borrow available books
  - Track borrower information (name and email)
  - Set and monitor due dates
  - Return borrowed books
  - View borrow history and status

- **Book Lookup**
  - Search books by title, author, or ISBN
  - View detailed book information
  - Check availability status

## MVC Structure

### Models
- **Book** (`app/Models/Book.php`)
  - Manages book data and relationships
  - Tracks quantity and availability
  
- **BorrowRecord** (`app/Models/BorrowRecord.php`)
  - Manages borrowing transactions
  - Tracks due dates and return status

### Controllers
- **BookController** (`app/Http/Controllers/BookController.php`)
  - Handles all book operations (CRUD)
  - Manages search functionality
  
- **BorrowController** (`app/Http/Controllers/BorrowController.php`)
  - Handles borrowing and returning books
  - Manages borrow records

### Views
- **Books** (`resources/views/books/`)
  - index.blade.php - List all books with search
  - create.blade.php - Add new book form
  - edit.blade.php - Edit book form
  - show.blade.php - Book details and history
  
- **Borrows** (`resources/views/borrows/`)
  - index.blade.php - List all borrow records
  - create.blade.php - Borrow book form
  - show.blade.php - Borrow record details

## Installation

1. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

2. **Configure Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Configure Database**
   
   Edit `.env` file and set your database credentials:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=library_app
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Run Migrations**
   ```bash
   php artisan migrate
   ```

5. **Seed Database (Optional)**
   
   Add sample books to get started:
   ```bash
   php artisan db:seed
   ```

6. **Start Development Server**
   ```bash
   php artisan serve
   ```

7. **Visit Application**
   
   Open your browser and go to: `http://localhost:8000`

## Database Schema

### books
- id
- title
- author
- isbn (unique)
- published_year
- quantity
- available_quantity
- timestamps

### borrow_records
- id
- book_id (foreign key)
- borrower_name
- borrower_email
- borrowed_at
- due_date
- returned_at (nullable)
- timestamps

## Routes

### Book Routes
- `GET /books` - List all books
- `GET /books/create` - Show create book form
- `POST /books` - Store new book
- `GET /books/{book}` - Show book details
- `GET /books/{book}/edit` - Show edit book form
- `PUT /books/{book}` - Update book
- `DELETE /books/{book}` - Delete book

### Borrow Routes
- `GET /borrows` - List all borrow records
- `GET /books/{book}/borrow` - Show borrow form
- `POST /books/{book}/borrow` - Store borrow record
- `GET /borrows/{borrowRecord}` - Show borrow details
- `POST /borrows/{borrowRecord}/return` - Return book

## Usage

### Adding a Book
1. Click "Add Book" in the navigation
2. Fill in book details (title, author, ISBN, year, quantity)
3. Click "Add Book"

### Borrowing a Book
1. View the book you want to borrow
2. Click "Borrow This Book" (only available if copies are available)
3. Enter your name and email
4. Select a due date
5. Click "Confirm Borrow"

### Returning a Book
1. Go to "Borrow Records"
2. Find the borrow record
3. Click "Return Book"

### Searching Books
1. On the books page, use the search box
2. Search by title, author, or ISBN
3. View filtered results

## No Authentication

This application does not include user authentication. Borrowers only need to provide their name and email when borrowing books.

## Technologies Used

- Laravel 11.x
- PHP 8.2+
- MySQL/SQLite
- Blade Templates
- CSS (inline styling)

## License

This is an educational project demonstrating Laravel MVC structure.
