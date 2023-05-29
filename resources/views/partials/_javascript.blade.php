<script
src="https://code.jquery.com/jquery-3.1.1.min.js"
integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
crossorigin="anonymous"></script>

<script type="text/javascript" src="{{ URL::asset('js/semantic.min.js') }}"></script>

<script>
      $(document).ready(function(){
          $('.ui.dropdown') .dropdown();
    });
</script>

@yield('scripts')