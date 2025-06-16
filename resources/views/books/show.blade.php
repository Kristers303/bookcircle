<x-layout>
<x-slot name='title'>
    {{__('messages.book_info')}}
</x-slot>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">

                <div class="mb-3">
                    <h5 class="card-title">{{__('messages.Title')}}</h5>
                    <p class="card-text">{{ $book->title }}</p>
                </div>

                <div class="mb-3">
                    <h5 class="card-title">{{__('messages.Author')}}</h5>
                    <p class="card-text">{{ $book->author }}</p>
                </div>

                <div class="mb-3">
                    <h5 class="card-title">{{__('messages.Year')}}</h5>
                    <p class="card-text">{{ $book->year }}</p>
                </div>

                <div class="mb-3">
                    <h5 class="card-title">{{__('messages.Genre')}}</h5>
                    <p class="card-text">{{ $book->genre?->name ?? '—' }}</p>
                </div>

                <div class="mb-3">
                    <h5 class="card-title">{{__('messages.Description')}}</h5>
                    <p class="card-text">{{ $book->description ?? '—' }}</p>
                </div>

                <div class="mb-3">
                    <h5 class="card-title">{{__('messages.Owner')}}</h5>
                    <p class="card-text">{{ $book->user?->name ?? '—' }}</p>    
                </div>

                <div class="mb-3">
                    <h5 class="card-title">{{__('messages.City')}}</h5>
                    <p class="card-text">{{ $book->user?->city ?? '—' }}</p>
                </div>
                <div class="mb-3">
                    <h5 class="card-title">{{__('messages.Status')}}</h5>
                    <p class="card-text">{{ $book->status }}</p>
                </div>

                <div class="mb-3">
                    <h5 class="card-title">{{__('messages.Created_at')}}</h5>
                    <p class="card-text">{{ $book->created_at?->format('Y-m-d H:i') ?? '—' }}</p>
                </div>

                <div class="mb-3">
                    <h5 class="card-title">{{__('messages.Last_updated')}}</h5>
                    <p class="card-text">{{ $book->updated_at?->format('Y-m-d H:i') ?? '—' }}</p>
                </div>

            </div>
        </div>
        @auth
                @if($book->status === 'available')
            <form action="{{ route('book.reserve', $book) }}" method="POST" class="mt-2">
                @csrf
                <button type="submit" class="btn btn-warning">{{__('messages.Reserve')}}</button>
            </form>
        @elseif($book->status === 'reserved')
            <span class="badge bg-secondary mt-2">{{__('messages.Reserved')}}</span>
        @else
            <span class="badge bg-light text-dark mt-2">{{__('messages.Not_available')}}</span>
        @endif
        @endauth
        @if(auth()->id() === $book->user_id && $book->status === 'reserved' && $book->reservedBy)
            <div class="alert alert-info mt-3">
                <strong>{{__('messages.Book_is_reserved')}}!</strong><br>
                {{__('messages.Reserve_user')}}: <br>
                {{__('messages.Name')}}: {{ $book->reservedBy->name }}<br>
                {{__('auth.Email_address')}}: {{ $book->reservedBy->email }}
            </div>
        @endif

        <h4>{{__('messages.Average_rating')}}: {{ round($book->averageRating(), 1) ?? __('messages.No_ratings') }}/5</h4>

        <!-- Vērtējuma forma -->
        <form action="{{ route('ratings.store', $book) }}" method="POST">
            @csrf
            <label>{{__('messages.Rating')}} (1-5):</label>
            <input type="number" name="rating" min="1" max="5" value="5">
            <button type="submit" class="btn btn-sm btn-success">{{__('messages.Submit')}}</button>
        </form>

        <hr>

        <!-- Komentāra forma -->
        <form action="{{ route('comments.store', $book) }}" method="POST">
            @csrf
            <textarea name="content" rows="3" class="form-control" placeholder="{{__('messages.Write_a_comment')}}..."></textarea>
            <button type="submit" class="btn btn-primary mt-2">{{__('messages.Add_comment')}}</button>
        </form>

        <!-- Komentāru saraksts -->
        @foreach($book->comments()->latest()->get() as $comment)
            <div class="mt-3">
                <strong>{{ $comment->user->name }}</strong> {{__('messages.Writen_by')}}:
                <p>{{ $comment->content }}</p>
                <small>{{ $comment->created_at->diffForHumans() }}</small>
                @if(auth()->check() && (auth()->id() == $comment->user_id || auth()->user()->is_admin))
                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{__('messages.Are_you_sure_delete_com')}}')">
                            {{__('messages.Delete')}}
                        </button>
                    </form>
                @endif
                <hr>
            </div>
        @endforeach

        <div class="mt-4 d-flex">
        @can('update', $book)
            <a href="{{ route('book.edit', $book->id) }}" class="btn btn-primary">{{__('messages.Edit')}}</a>
        @endcan
        @can('delete', $book)
            <form action="{{ route('book.destroy', $book) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mx-4" 
                onclick="return confirm('{{__('messages.Are_you_sure_delete_book')}}')">{{__('messages.Delete_book')}}</button>
            </form>
        @endcan        
            <a href="{{ route('book.index') }}" class="btn btn-secondary">{{__('messages.Back_to_list')}}</a>
        </div>
</x-layout>
