<x-layout>
    <x-slot name="title">
    Edit Book Listing
    </x-slot>
    <form action="{{ action( [App\Http\Controllers\BookController::class, 'update'], $book->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $book->title) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Authors</label>
            <input type="text" name="author" class="form-control" value="{{ old('author', $book->author) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Year</label>
            <input type="number" name="year" class="form-control" value="{{ old('year', $book->year) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Genre</label>
            <select name="genre_id" class="form-select">
                <option value="">Select Genre</option>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}" {{ $book->genre_id == $genre->id ? 'selected' : '' }}>
                        {{ $genre->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="5">{{ old('description', $book->description) }}</textarea>
        </div>
        <div    class="mb-3">
            <label class="form-label">City</label>
            <input type="text" name="city" class="form-control" value="{{ old('city', $user->city) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="available" {{ $book->status == 'available' ? 'selected' : '' }}>Available</option>
                <option value="unavailable" {{ $book->status == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                <option value="reserved" {{ $book->status == 'reserved' ? 'selected' : '' }}>Reserved</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Listing</button>
    </form>
</x-layout>