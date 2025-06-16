<x-layout>
<x-slot name='title'>
    {{__('auth.Register')}}
</x-slot>
    <div class="container mt-4">
        <form action="{{ route('register') }}" method="POST">
       
            @csrf
            
            <div class="mb-3">
                <label for="name" class="form-label">{{__('auth.Full_Name')}}</label>
                <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

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

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">{{__('auth.Confirm_Password')}}</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">{{__('auth.Register')}}</button>
            <a href="{{ route('login') }}" class="btn btn-link">{{__('auth.Already_have_an_account')}}</a>
        </form>
    </div>
</x-layout>



