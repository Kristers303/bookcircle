<x-layout>
    <x-slot name='title'>
        Book List
    </x-slot>

    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    @if ($books->isEmpty())
        <p>No books available.</p>
    @else
    <div class="container">
        <div class="row">
            @foreach($books as $book)
                <x-book-card :book="$book" />
            @endforeach
        </div>
    </div>
    @endif
</x-layout>
