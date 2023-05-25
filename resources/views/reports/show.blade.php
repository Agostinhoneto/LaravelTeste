@extends('layouts.app')

@section('content')

<h1>Perfil: {{ $profile->first_name}}</h1>

    <p>Title: {{ $report->title }}</p>
    <p>{{ $report->description }}</p>
   
    <a href="{{ route('reports.index') }}">Voltar para a lista de relatórios</a>
@endsection
