@extends('layouts.app')

@section('title', ' | Homepage')


@section('css-content')

<style>

.selected-phase {
  font-weight: bold !important;
  text-decoration: underline;
}

</style>

@endsection

@section('content')


  <h1 class="ui header">Phases</h1>

  <div class="ui relaxed divided list">
    @foreach ($phases as $phase)
      <div class="item">
        <i class="large github middle aligned icon"></i>
        <div class="content">
          <h3 class="{{ $phase->active == 1 ? 'selected-phase' : '' }}">
            <a class="header" onclick="selectPhase( {{ $phase }} );">Phase: {{ $phase->name }}</a>
          </h3>
          <div class="description">{{ $phase->active == 1 ? 'Active' : '' }}</div>
        </div>
      </div>    
    @endforeach

  </div>

@endsection

@section('scripts')

<script type="text/javascript">

    function selectPhase(phase) {
      console.log(phase);
      if(phase.active === '0') {
        axios.post(`${APP_URL}change-phase`, { id: phase.id}).then(response => {
          window.location.href = APP_URL + 'home';
        })
      }
    }

</script>


@endsection