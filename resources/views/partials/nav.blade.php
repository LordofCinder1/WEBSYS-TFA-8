<nav style="display:flex; align-items:center; flex-wrap:wrap;">
    <a href="{{ route('home') }}">Home</a>
    <a href="{{ route('about') }}">About</a>
    <a href="{{ route('customers.index') }}">Customers</a>
    <a href="{{ route('users.index') }}">Users</a>

    <div style="margin-left:auto; display:flex; align-items:center; gap:1rem;">
        @auth
            <span style="color:#94a3b8;">Logged in as {{ auth()->user()->full_name }}</span>
            @if (Route::has('logout'))
                <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                    @csrf
                    <button type="submit" style="background:none; border:1px solid #475569; border-radius:6px; color:#e2e8f0; cursor:pointer; font:inherit; font-weight:600; padding:4px 12px;">Log out</button>
                </form>
            @endif
        @else
            @if (Route::has('login'))
                <a href="{{ route('login') }}">Log in</a>
            @endif
            @if (Route::has('register'))
                <a href="{{ route('register') }}" style="margin-right:0;">Register</a>
            @endif
        @endauth
    </div>
</nav>
