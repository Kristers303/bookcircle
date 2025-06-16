<x-layout>
<x-slot name='title'>
    Book Info
</x-slot>
    <div class="container mt-4">

        <div class="card">
            <div class="card-body">

                <div class="mb-3">
                    <h5 class="card-title">Title</h5>
                    <p class="card-text">{{ $book->title }}</p>
                </div>

                <div class="mb-3">
                    <h5 class="card-title">Authors</h5>
                    <p class="card-text">{{ $book->author }}</p>
                </div>

                <div class="mb-3">
                    <h5 class="card-title">Year</h5>
                    <p class="card-text">{{ $book->year }}</p>
                </div>

                <div class="mb-3">
                    <h5 class="card-title">Genre</h5>
                    <p class="card-text">{{ $book->genre?->name ?? '—' }}</p>
                </div>

                <div class="mb-3">
                    <h5 class="card-title">Description</h5>
                    <p class="card-text">{{ $book->description ?? '—' }}</p>
                </div>

                <div class="mb-3">
                    <h5 class="card-title">Owner</h5>
                    <p class="card-text">{{ $book->user?->name ?? '—' }}</p>    
                </div>

                <div class="mb-3">
                    <h5 class="card-title">City</h5>
                    <p class="card-text">{{ $book->user?->city ?? '—' }}</p>
                </div>
                <div class="mb-3">
                    <h5 class="card-title">Status</h5>
                    <p class="card-text">{{ $book->status }}</p>
                </div>

                <div class="mb-3">
                    <h5 class="card-title">Created At</h5>
                    <p class="card-text">{{ $book->created_at?->format('Y-m-d H:i') ?? '—' }}</p>
                </div>

                <div class="mb-3">
                    <h5 class="card-title">Last Updated</h5>
                    <p class="card-text">{{ $book->updated_at?->format('Y-m-d H:i') ?? '—' }}</p>
                </div>

            </div>
        </div>

        <div class="mt-4 d-flex">
        <a href="{{ route('book.edit', $book->id) }}" class="btn btn-primary">Edit</a>
        @can('update', $book)

        @endcan
        @can('delete', $book)
            <form action="{{ route('book.destroy', $book) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mx-4" 
                onclick="return confirm('Are you sure you want to delete this book? This action cannot be undone.')">Delete Book</button>
            </form>
        @endcan        
            <a href="{{ route('book.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
</x-layout>
