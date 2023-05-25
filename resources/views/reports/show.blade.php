@extends('layouts.app')

@section('content')
    <h1>Perfil: {{ $profile->first_name}}</h1>

<h2>Relatório: {{ $report->title }}</h2>
<p>Conteúdo do relatório: {{ $report->description }}</p>

@endsection
