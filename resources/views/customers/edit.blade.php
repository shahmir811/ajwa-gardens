@extends('layouts.app')

@section('title', ' | Update Customer')

<style>

.cancel-button {
  margin-top: 10px !important;
}

</style>

@section('content')

  <h1 class="ui header">Update Customer</h1>

    <div class="ui centered grid">
      <div class="six wide tablet eight wide computer column">

        <form class="ui form" method="POST" action="{{ route('customers.update',$customer->id) }}">
          {{ method_field('PUT') }}
          @csrf

          <div class="field @error('name') error @enderror">
              <label>Name</label>
              <input id="Name" type="text" name="name" placeholder="Name" value="{{ old('name', $customer->name) }}" autofocus>
              @error('name')
                <span class="field error">
                    <strong class="error-text">{{ $message }}</strong>
                </span>
              @enderror
          </div>

          <div class="field @error('cnic') error @enderror">
              <label>CNIC</label>
              <input type="text" name="cnic" placeholder="cnic" value="{{ old('cnic', $customer->cnic) }}">
              @error('cnic')
                <span class="field error">
                    <strong class="error-text">{{ $message }}</strong>
                </span>
              @enderror
          </div>   

          <div class="field @error('contact') error @enderror">
              <label>Contact</label>
              <input type="text" name="contact" placeholder="contact" value="{{ old('contact', $customer->contact) }}">
              @error('contact')
                <span class="field error">
                    <strong class="error-text">{{ $message }}</strong>
                </span>
              @enderror
          </div>             
          

          <button class="fluid ui green button" type="submit">Update</button>          
          <a class="fluid ui button cancel-button" href="{{ url('/customers') }}">Cancel</a> 

        </form>

      </div>
    </div>

@endsection