@extends('layouts.app')

@section('title', ' | Plots')

<style>

.little-space-above {
  margin-top: 10px !important;
}

li.page-item > a{
  color: black !important;
}

li.active {
  font-weight: bold !important;
  text-decoration: underline !important;
}

</style>

@section('content')

  <h1 class="ui header">Plots</h1>

  <div class="row">
    <div class="column">
      <a class="ui green button" href="{{ url('/plots/create') }}">Add Plot</a>
    </div>
  </div>

  <div class="ui grid little-space-above">
    <div class="three column row">
      <div class="column">
        <select name="column" class="ui fluid dropdown" value="{{ old('column') }}">
          <option value="plot_no">Plot No</option>
          <option value="registration_no">Registration No</option>
          <option value="form_no">Form No</option>
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
        <button class="fluid ui green button" id='search-button'>Search</button>
      </div>
    </div>
  </div>    


  <div class="row little-space-above">
    <div class="column">
      <table class="ui sortable celled table">
        <thead>
          <tr>
            <th>Plot No</th>
            <th>Marla</th>
            <th>Type</th>
            <th>Registration No</th>
            <th>Form No</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($plots as $plot)
          <tr>
            <td data-label="PlotNo">{{ $plot->plot_no }}</td>
            <td data-label="Marla">{{ $plot->marla }}</td>
            <td data-label="Job">{{ $plot->type }}</td>
            <td data-label="Job">{{ $plot->registration_no }}</td>
            <td data-label="Job">{{ $plot->form_no }}</td>
            <td data-label="Job">{{ $plot->available ? 'Available' : 'Booked' }}</td>
            <td>
              <a href="{{ route('plots.edit', ['plot' => $plot]) }}">
                <i class="fa fa-edit"></i> Edit
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>      
      
      @if ($plots->hasPages())

      <div class='row'>
        <div class="column">
          {{  $plots->appends($_GET)->links() }}
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
      window.location.href = `${APP_URL}plots?column=${column}&search=${searchText}`;
    } else {
      window.location.href = APP_URL + 'plots';
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