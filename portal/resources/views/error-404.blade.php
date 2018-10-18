@extends('layouts.app')

@section('title', $node['fields']['title'])

@section('content')
    <div class="jumbotron">
        <h1 class="display-4">{{ $node['fields']['title'] }}</h1>
    </div>
@endsection
