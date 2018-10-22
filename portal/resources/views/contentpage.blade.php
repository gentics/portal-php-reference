@extends('layouts.app')

@section('title', $node['fields']['title'])

@section('content')
<div class="jumbotron">
    <h1 class="display-4">Gentics Mesh Demo Application</h1>
    <h2>{{$node['fields']['name']}}</h2>
    <a class="btn" href="https://getmesh.io/docs/beta/getting-started.html" role="button">Learn more</a>
</div>
@endsection

