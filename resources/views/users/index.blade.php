@extends('layouts.app')

@section('title', ' | Users')

<style>

.little-space-above {
  margin-top: 10px !important;
}

</style>

@section('content')

    <h1 class="ui header">Users</h1>

  <div class="row">
    <div class="column">
      <a class="ui green button" href="{{ url('/users/create') }}">Create User</a>
    </div>
  </div>

  <div class="row little-space-above">
    <div class="column">
      <table class="ui sortable celled table">
        <thead>
          <tr><th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Action</th>
        </tr></thead>
        <tbody>
          @foreach($users as $user)
          <tr>
            <td data-label="Name">{{ $user->name }}</td>
            <td data-label="Age">{{ $user->email }}</td>
            <td data-label="Job">{{ $user->role->name }}</td>
            <td>
              <a href="{{ route('users.edit', ['user' => $user]) }}">
                <i class="fa fa-edit"></i> Edit
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>      
    </div>
  </div>

@endsection