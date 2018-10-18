<div class="col-md-4">
    <div class="card">
        <h5 class="card-title"><a href="{{ $car['path'] }}">{{ $car['fields']['name'] }}</a></h5>
        <a href="{{ $car['path'] }}">
            <img class="card-img-top"
                 src="{{ $car['fields']['image'] ?? "/static/demo-assets/files/img/image-placeholder.png" }}"
                 alt="{{ $car['fields']['name'] }}">
        </a>
        <div class="card-body">

            <p class="card-text">{{ str_limit(strip_tags($car['fields']['vehicle_description']) ?? "", $limit = 60, $end = '...') }}</p>
        </div>
        <div class="card-footer text-left">
            <p class="price">${{ @number_format($car['fields']['price'] ?? 0, 0, ',', '.') ?? 0 }}</p>
            @if($car['fields']['stock'] > 3)
                <small class="text-muted float-right">in stock</small>
            @elseif($car['fields']['stock'] > 1)
                <small class="text-muted float-right">low stock number</small>
            @else
                <small class="text-muted float-right">not in stock</small>
            @endif
        </div>
    </div>
</div>