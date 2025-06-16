<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Book; 
use App\Models\Genre;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;



class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
    public function index()
    {
        if (auth()->check()) {
        $logs = Activity::causedBy(auth()->user())->latest()->get();
        } else {
            $logs = collect(); // Пустая коллекция
        }
        $books = Book::all();
        return view('books.index', compact('books', 'logs'));
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
        if ($request->user()->cannot('create')) {
            abort(403, __('messages.You_not_have_access_to_page'));
        }
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'year' => 'required|integer|min:0|max:' . date('Y'),
            'genre_id' => 'required|exists:genres,id',
            'description' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'status' => 'required|in:available,unavailable,reserved',
        ]);

        $book=Book::create([
            'title' => $validated['title'],
            'author' => $validated['author'],
            'year' => $validated['year'],
            'genre_id' => $validated['genre_id'],
            'description' => $validated['description'],
            'user_id' => auth()->id(),
            'status' => $validated['status'],
        ]);

        User::where('id', auth()->id())->update(['city' => $request->input('city')]);

        activity('book')
            ->performedOn($book)
            ->causedBy(auth()->user())
            ->log('izveidots');

        return redirect()->route('book.index')->with(__('messages.Book_created_successfully'));
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
        if ($request->user()->cannot('update', $book)) {
            abort(403, __('messages.You_not_have_access_to_page'));
        }

        $genres = Genre::all();
        $user = User::findOrFail(auth()->id());
        return view('books.edit', compact('book', 'genres', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::findOrFail($id);
        if ($request->user()->cannot('update', $book)) {
            abort(403, __('messages.You_not_have_access_to_page'));
        }

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

        User::where('id', auth()->id())->update(['city' => $request->input('city')]);

        return redirect()->route('book.index')->with('success', __('messages.Book_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        if (auth()->user()->cannot('delete', $book)) {
            abort(403, __('messages.You_not_have_access_to_page'));
        }
        $book->delete();
        return redirect()->route('book.index')->with('success', __('messages.Book_deleted_successfully'));
    }

    public function search(Request $request)
    {
        $query = Book::query();

        if ($request->filled('q')) {
            $search = $request->input('q');

            $query->where('title', 'like', "%{$search}%")
                ->orWhere('author', 'like', "%{$search}%")
                ->orWhereHas('genre', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
        }

        $books = $query->paginate(10);

        return view('books.index', compact('books'));
    }
    public function reserve(Book $book)
    {
        if ($book->status !== 'available') {
            return back()->with('error', __('messages.Book_not_available_for_reservation'));
        }

        $book->status = 'reserved';
        $book->reserved_by = auth()->id();
        $book->save();

        return back()->with('success', __('messages.Book_reserved_successfully'));
    }

}
