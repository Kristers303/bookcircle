<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Book; 
use App\Models\Genre;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all();
        return view('books.create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'year' => 'required|integer|min:0|max:' . date('Y'),
            'genre_id' => 'required|exists:genres,id',
            'description' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'status' => 'required|in:available,unavailable,reserved',
        ]);

        Book::create([
            'title' => $validated['title'],
            'author' => $validated['author'],
            'year' => $validated['year'],
            'genre_id' => $validated['genre_id'],
            'description' => $validated['description'],
            'user_id' => 1, //auth()->id()
            'status' => $validated['status'],
        ]);

        User::where('id', auth()->id())->update(['city' => $request->input('city')]);

        return redirect()->route('book.index')->with('success', 'Book created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::findOrFail($id);
        return view('books.show', compact('book')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Book $book)
    {
        
        $genres = Genre::all();
        $user = User::findOrFail(1); //auth()->id()
        return view('books.edit', compact('book', 'genres', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'year' => 'required|integer|min:0|max:' . date('Y'),
            'genre_id' => 'required|exists:genres,id',
            'description' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'status' => 'required|in:available,unavailable,reserved',
        ]);

        $book->update([
            'title' => $validated['title'],
            'author' => $validated['author'],
            'year' => $validated['year'],
            'genre_id' => $validated['genre_id'],
            'description' => $validated['description'],
            'status' => $validated['status'],
        ]);

        User::where('user_id', auth()->id())->update(['city' => $request->input('city')]);

        return redirect()->route('book.index')->with('success', 'Book created successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('book.index')->with('success', 'Book deleted successfully!');
    }
}
