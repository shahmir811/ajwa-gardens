<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>{{ config('app.name', 'Laravel') }} @yield('title')</title>
<link rel="stylesheet" href="{{ URL::asset('css/semantic.min.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/welcome.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/styles.css') }}" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

@yield('css-content')


<script type="text/javascript">
  let APP_URL = {!! json_encode(url('/').'/') !!}
</script>

{{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}" />
<script defer src="{{ mix('js/app.js') }}"></script> --}}