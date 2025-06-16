<div class="col-md-4 mb-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title">{{ $book->title }}</h5>
            <p class="card-text"><strong>{{__('messages.Author')}}</strong> {{ $book->author }}</p>
            <p class="card-text"><strong>{{__('messages.Year')}}:</strong> {{ $book->year }}</p>
            <p class="card-text"><strong>{{__('messages.Genre')}}:</strong> {{ $book->genre ? $book->genre->name : 'No genre' }}</p>
            <p class="card-text"><strong>{{__('messages.Description')}}:</strong> {{ $book->description ?? 'No description available' }}</p>
            <p class="card-text"><strong>{{__('messages.Owner')}}:</strong> {{ $book->user ? $book->user->name : 'No owner' }}</p>
            <p class="card-text"><strong>{{__('messages.City')}}:</strong> {{ $book->user ? $book->user->city : 'No city' }}</p>
            <p class="card-text"><strong>{{__('messages.Status')}}:</strong> {{ $book->status }}</p>
            <a href="{{ action([App\Http\Controllers\BookController::class,'show'], $book->id) }}" class="btn btn-primary">{{__('messages.Read_more')}}</a>
        </div>
    </div>
</div>
