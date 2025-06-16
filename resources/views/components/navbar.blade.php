<nav class="navbar navbar-expand-lg navbar-light bg-light">
<ul class="navbar-nav ms-auto">
    
    <li class="nav-item">
        <a class="nav-link" href="{{ route('book.index') }}">{{__('messages.Book_list')}}</a>
    </li>
    @auth
        <li class="nav-item">
            <a class="nav-link" href="{{ route('book.create') }}">{{__('messages.add_book')}}</a>
        </li>
        <li class="nav-item">
            <span class="nav-link">{{__('messages.Welcome')}} {{ Auth::user()->name }}</span>
        </li>
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn nav-link bg-transparent">
                    {{__('auth.Logout')}}
                </button>
            </form>
        </li>
    @endauth
    @guest
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{__('auth.Login')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">{{__('auth.Register')}}</a>
        </li>
    @endguest
        <li class="nav-item">
            <a class="nav-link" href="{{ url('lang/lv') }}">LV</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('lang/en') }}">EN</a>
        </li>	    
</ul>
</nav>