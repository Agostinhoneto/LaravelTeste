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
      <div class="col">
        <section>
            <h3>Detalhes do Perfil</h3>
            <ul>
                <li><strong>Email:</strong> {{ $profile->gender }}</li>
                <li><strong>Data de Nascimento:</strong> {{ $profile->dob}}</li>
            </ul>
        </section>
          </div>
      <div class="col">
        <section>
            <h3>Reports</h3>
            <p> Title: {{ $report->title }}</p>
            <p>Description: {{ $report->description }}</p>
        </section>
        <a href="{{ route('reports.index') }}">Back to list of reports</a>
      </div>
    </div>
 </div>
@endsection