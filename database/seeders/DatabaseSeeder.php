<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genre;
use App\Models\Book;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Genre::create(['name' => 'Fiction']);
        Genre::create(['name' => 'Non-Fiction']);
        Genre::create(['name' => 'Science Fiction']);
        Genre::create(['name' => 'Fantasy']);
        Genre::create(['name' => 'Mystery']);
        Genre::create(['name' => 'Romance']);
        Genre::create(['name' => 'Thriller']);
        Genre::create(['name' => 'Horror']);
        Genre::create(['name' => 'Biography']);
        Genre::create(['name' => 'History']);
        User::create([
        'name' => 'Admin User',
        'email' => 'admin@gmail.com',
        'password' => bcrypt('adminpassword'),
        'role' => 'admin',
        'city' => 'Riga',
        ]);

        Book::create([
            'title' => '1984',
            'author' => 'George Orwell',
            'year' => 1949,
            'genre_id' => 1,
            'description' => 'A dystopian novel about totalitarianism.',
            'user_id' => 1,
            'status' => 'available',
        ]);

        Book::create([
            'title' => 'To Kill a Mockingbird',
            'author' => 'Harper Lee',
            'year' => 1960,
            'genre_id' => 2,
            'description' => 'A story of racial injustice in the Deep South.',
            'user_id' => 1,
            'status' => 'available',
        ]);

        Book::create([
            'title' => 'The Great Gatsby',
            'author' => 'F. Scott Fitzgerald',
            'year' => 1925,
            'genre_id' => 1,
            'description' => 'A novel about the American dream and lost love.',
            'user_id' => 1,
            'status' => 'reserved',
        ]);

        Book::create([
            'title' => 'Pride and Prejudice',
            'author' => 'Jane Austen',
            'year' => 1813,
            'genre_id' => 3,
            'description' => 'A romantic novel that critiques social class.',
            'user_id' => 1,
            'status' => 'available',
        ]);

        Book::create([
            'title' => 'Brave New World',
            'author' => 'Aldous Huxley',
            'year' => 1932,
            'genre_id' => 1,
            'description' => 'A futuristic society driven by consumerism and control.',
            'user_id' => 1,
            'status' => 'borrowed',
        ]);


    }
}
