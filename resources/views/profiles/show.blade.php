@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col">
        <header>
            <h2>Profile : </h2>
              <p><h3> {{ $profile->first_name }}<h3></p>
        </header>
      </div>
    </div>
 </div>
@endsection