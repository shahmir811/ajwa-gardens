@extends('layouts.app')

@section('title', ' | Allotments')

<style>

.little-space-above {
  margin-top: 10px !important;
}

ul.pagination {
    font-size: 15px !important;
    padding-top: 10px !important; 
}

li.page-item > a{
  color: black !important;
}

li.active {
  font-weight: bold !important;
  text-decoration: underline !important;
  color: blue !important;
}

</style>

@section('content')

  <h1 class="ui header">Allotments</h1>

  <div class="row">
    <div class="column">
      <a class="ui green button" href="{{ url('/allotment/create') }}">
        <i class="fa fa-plus-circle" aria-hidden="true"></i> New Allotment
      </a>
    </div>
  </div>

  <div class="ui grid little-space-above">
    <div class="three column row">
      <div class="column">
        <select name="column" class="ui fluid dropdown" value="{{ old('column') }}">
          <option value="plot_no">Plot No</option>
          <option value="name">Customer Name</option>
          <option value="registration_no">Registration Number</option>
          <option value="form_no">Form Number</option>
        </select>
      </div>

      <div class="column">
        <div class="ui form">
          <div class="field">
            <input type="text" name='search' placeholder="Search" value="{{ old('search') }}">
          </div>
        </div>
      </div>
      <div class="column">
        <button class="fluid ui green button" id='search-button'>
          <i class="fa fa-search" aria-hidden="true"></i> Search
        </button>
      </div>
    </div>
  </div>    

  <div class="row little-space-above">
    <div class="column">
      <table class="ui sortable celled table">
        <thead>
          <tr>
            <th>Plot No</th>
            <th>Customer Name</th>
            <th>Monthly Installment</th>
            <th>Down Payment</th>
            <th>Registration Number</th>
            <th>Form Number</th>
            {{-- <th>Remaining Amount</th> --}}
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @if (sizeof($allotments) > 0)
            @foreach($allotments as $allotment)
            <tr>
              <td data-label="PlotNo">{{ $allotment->plot->plot_no }}</td>
              <td data-label="CustomerName">{{ $allotment->customer->name }}</td>
              <td data-label="MonthlyInstallment">{{ number_format($allotment->monthly_amount, 0) }}</td>
              <td data-label="DownPayment">{{ number_format($allotment->down_amount, 0) }}</td>
              <td data-label="RegistrationNo">{{ $allotment->registration_no}}</td>
              <td data-label="FormNo">{{ $allotment->form_no}}</td>
              {{-- <td data-label="RemainingAmount">{{ $allotment->schedules[0]->remaining_amount }}</td> --}}
              <td>
                <a href="{{ route('view-allotment', ['id' => $allotment->id]) }}">
                  <i class="fa fa-eye"></i> View
                </a>
              </td>
            </tr>
            @endforeach
          @endif
        </tbody>
      </table>      
      
      @if (sizeof($allotments) > 0 && $allotments->hasPages())

      <div class='row'>
        <div class="column">
          {{  $allotments->appends($_GET)->links() }}
        </div>
      </div>

      @endif

    </div>
  </div>

@endsection

@section('scripts')

<script type="text/javascript">

  document.getElementById('search-button').addEventListener('click', searchResult);

  function searchResult() {
    const column = document.querySelector('[name="column"]').value;
    const searchText = document.querySelector('[name="search"]').value;
    console.log(searchText);
    if(searchText) {
      window.location.href = `${APP_URL}allotment?column=${column}&search=${searchText}`;
    } else {
      window.location.href = APP_URL + 'allotment';
    }
  }

  function init() {

    let url = new URL(window.location.href);
    let params = new URLSearchParams(url.search.slice(1));

    if(params.size) {
      let obj = {};
      for(let pair of params.entries()) {
          obj[pair[0]] = pair[1]    //push keys/values to object
      }
      if(obj['search']) {
        document.querySelector('[name="column"]').value = obj['column'];
        document.querySelector('[name="search"]').value = obj['search'];    
      }
    }
    


  }

  init();

</script>


@endsection