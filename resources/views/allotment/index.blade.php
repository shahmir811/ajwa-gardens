@extends('layouts.app')

@section('title', ' | Allotment')

@section('content')

    <h1 class="ui header">New Allotment</h1>

    <div id="app">
        <allotment-component></allotment-component>
    </div>

@endsection



@section('scripts')

{{-- <script src="{{ mix('js/app.js') }}"></script> --}}
@vite(['resources/js/app.js'])

@endsection