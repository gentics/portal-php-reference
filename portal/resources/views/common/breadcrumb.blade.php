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
        @if($folder['node']['fields']['startpage']['path'] != ($node['node']['path'] ?? ""))
            <li class="breadcrumb-item">
                <a href="{{ $folder['node']['path'] ?? "#" }}">
                    {{ $folder['node']['fields']['name'] ?? "" }}
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{ $node['fields']['name'] ?? "" }}
            </li>
        @else
            <li class="breadcrumb-item active" aria-current="page">
                {{ $folder['node']['fields']['name'] ?? "" }}
            </li>
        @endif
    </ol>
</nav>
