<x-layout>
<x-slot name='title'>
    {{__('auth.Login')}}
</x-slot>
    <div class="container mt-4">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="mb-3">
                <label for="email" class="form-label">{{__('auth.Email_address')}}</label>
                <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">{{__('auth.Password')}}</label>
                <input type="password" name="password" class="form-control" required>
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <button type="submit" class="btn btn-primary">{{__('auth.Login')}}</button>
            <a href="{{ route('register') }}" class="btn btn-link">{{__('auth.Dont_have_an_account')}}</a>
        </form>
    </div>
</x-layout>



