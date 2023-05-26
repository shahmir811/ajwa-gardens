@extends('layouts.app')

@section('title', ' | Login')

@section('content')

    <h1 class="ui header">Login User</h1>
    <div class="ui divider"></div>

    <div class="ui segment">
        <form class="ui form" method="POST" action="{{ route('login') }}">

            @csrf
                <div class="field @error('email') error @enderror">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" autofocus>
                    @error('email')
                        <span class="field error">
                            <strong class="error-text">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="field @error('password') error @enderror">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Password">
                    @error('password')
                        <span class="field error">
                            <strong class="error-text">{{ $message }}</strong>
                        </span>
                    @enderror                        
                </div>
                <button class="fluid ui green button" type="submit">Login</button>
                {{-- <div class="ui two bottom attached buttons">
                    <div class="fluid ui secondary button" type="submit">Login</div>
                    <div class="ui button" id='new-user'>New User</div>
                </div> --}}
        </form>
    </div>

@endsection

@section('scripts')

<script type="text/javascript">

    document.getElementById('new-user').addEventListener('click', gotoRegisterPage);

    function gotoRegisterPage() {
        window.location.href = APP_URL + 'register';
    }

</script>


@endsection