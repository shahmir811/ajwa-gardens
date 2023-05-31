<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials._head')
            
</head>
<body>

    @include('partials._menu')

    @auth

    <div class="ui grid pads-left-right">

        @include('partials._side-menu')
        @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

        <div class="twelve wide stretched column">
            <div class="ui segment">
                @yield('content')
            </div>
        </div>
    </div>    

    @else

    <div class="ui container">
        @yield('content')
    </div>

    @endauth
    

    @include('partials._javascript')

    @yield('js-content')

    @include('partials._footer')
    
</body>
</html>