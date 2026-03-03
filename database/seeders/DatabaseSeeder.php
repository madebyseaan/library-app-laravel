<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create sample books
        Book::create([
            'title' => 'The Great Gatsby',
            'author' => 'F. Scott Fitzgerald',
            'isbn' => '978-0-7432-7356-5',
            'published_year' => 1925,
            'quantity' => 3,
            'available_quantity' => 3,
        ]);

        Book::create([
            'title' => 'To Kill a Mockingbird',
            'author' => 'Harper Lee',
            'isbn' => '978-0-06-112008-4',
            'published_year' => 1960,
            'quantity' => 5,
            'available_quantity' => 5,
        ]);

        Book::create([
            'title' => '1984',
            'author' => 'George Orwell',
            'isbn' => '978-0-452-28423-4',
            'published_year' => 1949,
            'quantity' => 2,
            'available_quantity' => 2,
        ]);

        Book::create([
            'title' => 'Pride and Prejudice',
            'author' => 'Jane Austen',
            'isbn' => '978-0-14-143951-8',
            'published_year' => 1813,
            'quantity' => 4,
            'available_quantity' => 4,
        ]);

        Book::create([
            'title' => 'The Catcher in the Rye',
            'author' => 'J.D. Salinger',
            'isbn' => '978-0-316-76948-0',
            'published_year' => 1951,
            'quantity' => 2,
            'available_quantity' => 2,
        ]);
    }
}
