@extends('layouts.app')

@section('title', ' | New Allotment')

@section('content')

    <h1 class="ui header">New Allotment</h1>

    <div id="app">
        <allotment-component :plots="{{ $plots }}" :customers="{{ $customers }}"></allotment-component>
    </div>

@endsection



@section('scripts')

@vite(['resources/js/app.js'])

@endsection