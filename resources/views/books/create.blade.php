<x-layout>
    <x-slot name="title">
    Create New Book Listing
    </x-slot>
    <form method="POST" action="{{ route('book.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Authors</label>
            <input type="text" name="author" class="form-control" value="{{ old('author') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Year</label>
            <input type="number" name="year" class="form-control" value="{{ old('year') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Genre</label>
            <select name="genre_id" class="form-select">
                <option value="">Select Genre</option>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
                        {{ $genre->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="5">{{ old('description') }}</textarea>
        </div>
        <div    class="mb-3">
            <label class="form-label">City</label>
            <input type="text" name="city" class="form-control" value="{{ old('city') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                <option value="unavailable" {{ old('status') == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                <option value="reserved" {{ old('status') == 'reserved' ? 'selected' : '' }}>Reserved</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create Listing</button>
    </form>
</x-layout>