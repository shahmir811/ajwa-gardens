@extends('layouts.app')

@section('title', ' | Add Plot')

<style>

.cancel-button {
  margin-top: 10px !important;
}

</style>

@section('content')

  <h1 class="ui header">Add Plot</h1>

    <div class="ui centered grid">
      <div class="six wide tablet eight wide computer column">

        <form class="ui form" method="POST" action="{{ route('plots.store') }}">
          @csrf

          <div class="field @error('plot_no') error @enderror">
              <label>Plot No</label>
              <input id="plot_no" type="text" name="plot_no" placeholder="Plot No" value="{{ old('plot_no') }}" autofocus>
              @error('plot_no')
                <span class="field error">
                    <strong class="error-text">{{ $message }}</strong>
                </span>
              @enderror
          </div>

          <div class="field @error('marla') error @enderror">
              <label>Marla</label>
              <input type="number" name="marla" placeholder="Marla" step=".001" value="{{ old('marla') }}">
              @error('marla')
                <span class="field error">
                    <strong class="error-text">{{ $message }}</strong>
                </span>
              @enderror
          </div>   

          <div class="field">
            <label>Type</label>
            <select name="type" class="ui fluid dropdown" value="{{ old('type') }}">
              <option value="residential" {{ ( old("type") == 'residential' ? "selected":"") }}>Residential</option>
              <option value="commercial" {{ ( old("type") == 'commercial' ? "selected":"") }}>Commercial</option>
            </select>
          </div>        
          
          <div class="field">
            <label>Corner plot</label>
            <select name="corner_plot" class="ui fluid dropdown" value="{{ old('corner_plot') }}">
              <option value="0" {{ ( old("corner_plot") == 0 ? "selected":"") }}>No</option>
              <option value="1" {{ ( old("corner_plot") == 1 ? "selected":"") }}>Yes</option>
            </select>
          </div>                  
          
          <button class="fluid ui green button" type="submit">Create</button>          
          <a class="fluid ui button cancel-button" href="{{ url('/plots') }}">Cancel</a> 
        </form>

      </div>
    </div>  



@endsection