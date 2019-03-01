@extends('layouts.app')
@section('content')
@include('common.breadcrumb')
<div class="float-right">
    <a href="{!! $node['fields']['image'] ?? " /static/demo-assets/files/img/image-placeholder.png " !!}">
        <img class="img-thumbnail  img-item" src="{!! $node['fields']['image'] ?? "/static/demo-assets/files/img/image-placeholder.png"  !!}" alt="{{ $node['fields']['name'] }}">
    </a>
</div>
{{--<a href="{!! gisImage('510', 'auto', 'prop', $node['fields']['image']) ?? " " !!}">
    <img class="img-thumbnail float-right img-item"
            src="{!! gisImage('510', 'auto', 'prop', $node['fields']['image']) ?? "" !!}"
            alt="{{ $node['fields']['name'] }}">
</a>--}}

<section class="item-details text-left">
    <h3 class="item-title text-left">{{ $node['fields']['name'] }}</h3>

    <rating node-uuid="{{ $node['uuid'] }}" lang="en"></rating>

    <h6 class="item-price">$<span class="item-detail" style="min-width:1.2em;display:inline-block">{!! @number_format($node['fields']['price'] ?? 0, 0, ',', '.') ?? $node['fields']['price'] ?? 0 !!}</span></h6>
    <p>Weight: <span class="item-detail" style="min-width:1.2em;display:inline-block">{!! $node['fields']['weight'] ?? 0 !!}</span></p>
    <p>Stock Level: <span class="item-detail" style="min-width:1.2em;display:inline-block">{!! $node['fields']['stock'] ?? 0 !!}</span>
        @if($node['fields']['stock'] > 1)
            <i class="fas fa-check"></i>
        @else
            <i class="fas fa-times text-danger"></i>
        @endif
    </p>
    <p class="item-about">
        <div class="item-detail">{!! $node['fields']['vehicle_description'] ?? "" !!}</div>
    </p>
</section>
@endsection
