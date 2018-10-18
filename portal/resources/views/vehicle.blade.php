@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
@endpush

@section('content')
    @include('common.breadcrumb')

    <div class="float-right">
        <a href="{!! $node['fields']['image'] ?? "/static/demo-assets/files/img/image-placeholder.png" !!}">
                <img class="img-thumbnail  img-item"
                src="{!! $node['fields']['image'] ?? "/static/demo-assets/files/img/image-placeholder.png"  !!}"
                alt="{{ $node['fields']['name'] }}">
        </a>
    </div>
    {{--<a href="{!! gisImage('510', 'auto', 'prop', $node['fields']['image']) ?? "" !!}">
        <img class="img-thumbnail float-right img-item"
             src="{!! gisImage('510', 'auto', 'prop', $node['fields']['image']) ?? "" !!}"
             alt="{{ $node['fields']['name'] }}">
    </a>--}}

    <section class="item-details text-left">
        <h3 class="item-title text-left">{{ $node['fields']['name'] }}</h3>
        {{--<div class="rating-stars text-left">
            <a class="reviews" href="#" onfocus="openReview()" onfocusout="closeReview()">1.445</a>
            <i class="fas fa-star-half-alt"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
        </div>
        <div class="starReviews col-xl-4 col-lg-3 col-sm-8 row d-none">
            <div class="review-left col-lg-6 col-sm-12">
                <div class="progress">
                    <div class="progress-bar text-left pl-2" role="progressbar" style="width: 90%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" title="50%">5 star</div>
                </div>
                <div class="progress">
                    <div class="progress-bar text-left pl-2" role="progressbar" style="width: 30%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" title="50%">4 star</div>
                </div>
                <div class="progress">
                    <div class="progress-bar text-left pl-2" role="progressbar" style="width: 50%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" title="50%">3 star</div>
                </div>
                <div class="progress">
                    <div class="progress-bar text-left pl-2" role="progressbar" style="width: 25%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" title="50%">2 star</div>
                </div>
                <div class="progress">
                    <div class="progress-bar text-left pl-2" role="progressbar" style="width: 20%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" title="50%">1 star</div>
                </div>
            </div>
            <div class="review-right col-lg-6 col-sm-12">
                <p class="mb-0 mt-3">Leave your rating</p>
                <div class="rating-stars text-center pt-3">
                    <a class="r1">
                        <i class="fas fa-star"></i>
                    </a>
                    <a class="r2">
                        <i class="fas fa-star"></i>
                    </a>
                    <a class="r3">
                        <i class="fas fa-star"></i>
                    </a>
                    <a class="r4">
                        <i class="fas fa-star"></i>
                    </a>
                    <a class="r5">
                        <i class="fas fa-star"></i>
                    </a>
                </div>
            </div>
        </div>--}}
        <h6 class="item-price">$<span class="item-detail" style="min-width:1.2em;display:inline-block">{!! @number_format($node['fields']['price'] ?? 0, 0, ',', '.') ?? $node['fields']['price'] ?? 0 !!}</span></h6>
        <p>Weight: <span class="item-detail" style="min-width:1.2em;display:inline-block">{!! $node['fields']['weight'] ?? 0 !!}</span></p>
        <p>Stock Level: <span class="item-detail" style="min-width:1.2em;display:inline-block">{!! $node['fields']['stock'] ?? 0 !!}</span>
            @if($node['fields']['stock'] > 1)
                <i class="fas fa-check"></i>
            @else
                <i class="fas fa-times text-danger"></i>
            @endif
        </p>
        <p class="item-about"><div class="item-detail">{!! $node['fields']['vehicle_description'] ?? "" !!}</div></p>
    </section>
@endsection

@push('scripts')
    <script src="/static/demo-assets/files/js/itemapp.js"></script>
@endpush