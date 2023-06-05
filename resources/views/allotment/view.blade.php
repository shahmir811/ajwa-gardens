@extends('layouts.app')

@section('title', ' | Allotment Details')

@section('css-content')

<style>

div.print-schedule-div {
  display: flex;
  justify-content: space-between;
}

.mt-25 {
  margin-top: 25px !important;
}

</style>

@endsection


@section('content')

    <h1 class="ui header">Allotment Details</h1>

    <div class="ui top attached tabular menu">
      <a class="item active" data-tab="first">Payment Plan</a>
      <a class="item" data-tab="second">Plot Details</a>
    </div>
    <div class="ui bottom attached tab segment active" data-tab="first">
      <div class="print-schedule-div">
        <a class="ui blue button" href="{{ url('/allotment') }}">
          <i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back
        </a>
        <button class="ui red button"><i class="fa fa-print" aria-hidden="true"></i> Print Schedule</button>
      </div>

      <div id="app" class="mt-25">
        <receive-installment></receive-installment>

        <payment-details :allotment="{{ $allotment }}" :schedules="{{ $allotment->schedules }}"></payment-details>
      </div>

    </div>
    <div class="ui bottom attached tab segment" data-tab="second">
      @include('partials._allotment-details')
    </div>
    

@endsection


@section('scripts')

@vite(['resources/js/app.js'])

@endsection
