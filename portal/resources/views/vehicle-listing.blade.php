@extends('layouts.app')

@section('content')
    @include('common.breadcrumb')
    <div class="all-cards">
        <div class="card-deck">
            @foreach($folder['pages']['elements'] as $car)
                @if($car['fields'] && ($car['fields']['templateName'] ?? "") == 'vehicle')
                    @include('vehicle.item-card', ['car' => $car])
                @endif
            @endforeach
        </div>
    </div>
@endsection