<x-layout>
    <x-slot name="title">
{{__('messages.Email_address')}}    </x-slot>
    <form method="POST" action="{{ route('book.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">{{__('messages.Title')}}</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">{{__('messages.Author')}}</label>
            <input type="text" name="author" class="form-control" value="{{ old('author') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">{{__('messages.Year')}}</label>
            <input type="number" name="year" class="form-control" value="{{ old('year') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">{{__('messages.Genre')}}</label>
            <select name="genre_id" class="form-select">
                <option value="">{{__('messages.Select_genre')}} Genre</option>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
                        {{ $genre->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">{{__('messages.Description')}}</label>
            <textarea name="description" class="form-control" rows="5">{{ old('description') }}</textarea>
        </div>
        <div    class="mb-3">
            <label class="form-label">{{__('messages.City')}}</label>
            <input type="text" name="city" class="form-control" value="{{ old('city') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">{{__('messages.Status')}}</label>
            <select name="status" class="form-select">
                <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>{{__('messages.Avilable')}}</option>
                <option value="unavailable" {{ old('status') == 'unavailable' ? 'selected' : '' }}>{{__('messages.Unavailable')}}</option>
                <option value="reserved" {{ old('status') == 'reserved' ? 'selected' : '' }}>{{__('messages.Reserved')}}</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">{{__('messages.Create')}}</button>
    </form>
</x-layout>