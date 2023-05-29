@extends('layouts.app')

@section('title', ' | Customers')

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

  <h1 class="ui header">Customers</h1>

  <div class="row">
    <div class="column">
      <a class="ui green button" href="{{ url('/customers/create') }}">Add Customer</a>
    </div>
  </div>

  <div class="ui grid little-space-above">
    <div class="three column row">
      <div class="column">
        <select name="column" class="ui fluid dropdown" value="{{ old('column') }}">
          <option value="name">Name</option>
          <option value="father_name">Father Name</option>
          <option value="cnic">CNIC</option>
          <option value="contact">Contact</option>
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
            <th>Name</th>
            <th>Father Name</th>
            <th>CNIC</th>
            <th>Contact</th>
            <th>Action</th>
        </tr></thead>
        <tbody>
          @foreach($customers as $customer)
          <tr>
            <td data-label="Name">{{ $customer->name }}</td>
            <td data-label="Name">{{ $customer->father_name }}</td>
            <td data-label="Age">{{ $customer->cnic }}</td>
            <td data-label="Job">{{ $customer->contact }}</td>
            <td>
              <a href="{{ route('customers.edit', ['customer' => $customer]) }}">
                <i class="fa fa-edit"></i> Edit
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>      
      
      @if ($customers->hasPages())

      <div class='row'>
        <div class="column">
          {{  $customers->appends($_GET)->links() }}
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
      window.location.href = `${APP_URL}customers?column=${column}&search=${searchText}`;
    } else {
      window.location.href = APP_URL + 'customers';
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