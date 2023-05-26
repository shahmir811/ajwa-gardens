@extends('layouts.app')

@section('title', ' | Add Customer')

<style>

.cancel-button {
  margin-top: 10px !important;
}

</style>

@section('content')

  <h1 class="ui header">Add Customer</h1>

    <div class="ui centered grid">
      <div class="six wide tablet eight wide computer column">

        <form class="ui form" method="POST" action="{{ route('customers.store') }}">
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

          <div class="field @error('cnic') error @enderror">
              <label>CNIC</label>
              <input type="text" name="cnic" placeholder="cnic" value="{{ old('cnic') }}">
              @error('cnic')
                <span class="field error">
                    <strong class="error-text">{{ $message }}</strong>
                </span>
              @enderror
          </div>   

          <div class="field @error('contact') error @enderror">
              <label>Contact</label>
              <input type="text" name="contact" placeholder="contact" value="{{ old('contact') }}">
              @error('contact')
                <span class="field error">
                    <strong class="error-text">{{ $message }}</strong>
                </span>
              @enderror
          </div>             
          

          <button class="fluid ui green button" type="submit">Create</button>          
          <a class="fluid ui button cancel-button" href="{{ url('/customers') }}">Cancel</a> 
        </form>

      </div>
    </div>  



@endsection