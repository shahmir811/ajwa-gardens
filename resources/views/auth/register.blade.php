@extends('layouts.app')

@section('title', ' | Register')

@section('content')

  <h1 class="ui header">Register User</h1>
  <div class="ui divider"></div>

  <div class="ui segment">
    <form class="ui form" method="POST" action="{{ route('register') }}">

        @csrf

        <div class="field @error('name') error @enderror">
            <label>Name</label>
            <input id="Name" type="text" name="name" placeholder="Name" value="{{ old('name') }}" autofocus>
            @error('name')
                <span class="field error">
                    <strong class="error-text">{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="field @error('email') error @enderror">
            <label>Email</label>
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
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

        <div class="field">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" placeholder="Confirm Password">                   
        </div>

        <button class="ui button" type="submit">Register</button>
    </form>
  </div>

@endsection