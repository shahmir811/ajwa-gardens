<div class="four wide column">
    <div class="ui vertical fluid tabular menu">
        <a class="item {{ request()->is('home') ? 'active' : '' }}" href="{{ url('/home') }}">
            Home
        </a>

        @auth
            @if( Auth::user()->role_id == 1)
            <a class="item {{ request()->is('users*') ? 'active' : '' }}" href="{{ url('/users') }}">
                Users
            </a>
            @endif

        @endauth
        
        <a class="item {{ request()->is('customers*') ? 'active' : '' }}" href="{{ url('/customers') }}">
            Customers
        </a>
        <a class="item">
            Plots
        </a>
    </div>
</div>