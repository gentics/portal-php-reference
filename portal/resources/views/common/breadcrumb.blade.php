<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/">Home</a>
        </li>
        @if(isset($node['breadcrumb']))
            @foreach (array_reverse($node['breadcrumb']) as $breadcrumb)
                @if(@isset($breadcrumb['node']['fields']['startpage']['path']) && @isset($node['node']['path']) && $node['node']['path'] != $breadcrumb['node']['fields']['startpage']['path'] && !$loop->last)
                    <li class="breadcrumb-item">
                        <a href="{{ $breadcrumb['node']['fields']['startpage']['path'] }}">
                            {{ $breadcrumb['node']['fields']['name'] }}
                        </a>
                    </li>
                @endif
            @endforeach
        @endif
        <li class="breadcrumb-item active" aria-current="page">
        @if($folder['node']['fields']['startpage']['path'] != ($node['node']['path'] ?? ""))
            {{ $node['fields']['name'] ?? "" }}
        @else
            {{ $folder['node']['fields']['name'] ?? "" }}
        @endif
        </li>
    </ol>
</nav>
