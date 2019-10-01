@extends('layouts.app')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ $project['rootNode']['children']['elements'][0]['fields']['startpage']['path'] ?? "/" }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Search{{ !empty($search['query']['q']) ? ': '.$search['query']['q'] : ''}}</li>
        </ol>
    </nav>

    <main class="container container-main">

        <div class="searchLine row">
            <div class="sortby col-6 mb-4 text-left">
            @if(!empty($search['query']))
                @if($search['resultCount'] === 1)
                    <span class="resultCount">One</span> result
                @elseif($search['resultCount'] > 1)
                    <span class="resultCount">{{$search['resultCount']}}</span> results
                @else
                    <span class="resultCount">No</span> results found
                @endif
            @else
                To search, type phrases in the search field above.
            @endif
            </div>
            {{--<div class="sortby col-6 mb-4 text-right">
                Sort by: <div class="dropdown d-inline">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Most popular
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Price ascending</a>
                        <a class="dropdown-item" href="#">Price descending</a>
                        <a class="dropdown-item" href="#">Shipping time</a>
                    </div>
                </div>
            </div>--}}
        </div>

        @if(!empty($search['didYouMean']))
        <div class="didyoumean row">
            Did you mean: <a href="?q={{ $search['didYouMean'] }}">{{ $search['didYouMean'] }}</a>
        </div>
        @endif

        <div class="all-cards">
            <div class="card-deck">
                @foreach($search['results'] as $car)
                    @if($car['raw']['fields'])
                        @include('vehicle.item-card', [ 'car' => Helper::normalizeSearchHit($car) ])
                    @endif
                @endforeach
            </div>
        </div>

        @if(isset($search['pageCount']) && $search['pageCount'] > 1)
            @include('common.pagination', ['pageCount' => $search['pageCount'], 'currentPage' => $search['currentPage']])
        @endif
    </main>
@endsection