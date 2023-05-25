@extends('layouts.app')

@section('title', ' | Users')

@section('css-content')

<style>

.cancel-button {
  margin-top: 10px !important;
}

</style>


@endsection


@section('content')

    <h1 class="ui header">Create Users</h1>

    <div class="ui centered grid">
      <div class="six wide tablet eight wide computer column">

        <form class="ui form" method="POST" action="{{ route('users.store') }}">
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
          
          <div class="field">
            <label>Role</label>
            <select name="role_id" class="ui fluid dropdown" value="{{ old('role_id') }}">
              <option value="1" {{ ( old("role_id") == 1 ? "selected":"") }}>Admin</option>
              <option value="2" {{ ( old("role_id") == 2 ? "selected":"") }}>Employee</option>
            </select>
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

          <button class="fluid ui green button" type="submit">Create</button>          
          <a class="fluid ui button cancel-button" href="{{ url('/users') }}">Cancel</a> 
        </form>

      </div>
    </div>

@endsection