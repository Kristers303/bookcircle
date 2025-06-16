<x-layout>
    <x-slot name='title'>
        {{__('messages.Book_list')}}
    </x-slot>

    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('book.search') }}" method="GET" class="mb-3">
    <input type="text" name="q" class="form-control" placeholder="{{__('messages.Find_book_placeholder')}}" value="{{ request('q') }}">
    <button type="submit" class="btn btn-primary mt-2">{{__('messages.Search')}}</button>
    </form>

    
    @if ($books->isEmpty())
        <p>{{__('messages.No_books_found')}}.</p>
    @else
    <div class="container">
        <div class="row">
            @foreach($books as $book)
                <x-book-card :book="$book" />
            @endforeach
        </div>
    </div>
    @endif

    @foreach($logs as $log)
    <p>{{ $log->description }} - {{ $log->causer->name ?? 'Sistēma' }} - {{ $log->created_at }}</p>
@endforeach
</x-layout>
