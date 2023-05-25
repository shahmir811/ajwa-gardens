<div class="ui secondary  menu header">
  <h1>
    <a class="item">
    Home
    </a>
  </h1>
  <div class="right menu">
      @auth
      <li class="ui item">
        Welcome {{ Auth::user()->name }}
      </li>
      <div class="logout-button-div">
        <a class="ui item" href="{{ route('logout') }}" 
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
          Logout
        </a>     
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>           
      </div>    
      @else  
      <a class="ui item" href="{{ route('login') }}">
        Login
      </a>
      <a class="ui item" href="{{ route('register') }}">
        Register
      </a>
      @endauth          
  </div>
</div>