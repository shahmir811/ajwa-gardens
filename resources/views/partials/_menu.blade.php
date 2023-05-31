<div class="ui secondary  menu header">
  <h1>
    <a class="item">
    Home
    </a>
  </h1>
  <div class="right menu">
      @auth
      <div class="ui right dropdown item">
        Welcome {{ Auth::user()->name }}
        <i class="dropdown icon"></i>
        <div class="menu">
          <a class="item" href="{{ route('allotment') }}">
            New Allotment
          </a>
          <div class="item">International Students</div>
          <div class="item">
            <a class="ui item no-pad-margin" href="{{ route('logout') }}" 
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
              Logout
            </a>                 
          </div>
        </div>
      </div>  

      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
      </form>                
      
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