@if (isset($elem['fields']['name']) && ends_with($elem['schema']['name'], '_folder') && !$elem['fields']['navhidden'])
    <li class="nav-item active">
        <a class="nav-link{{ starts_with( $node['node']['path'] ?? "", $elem['path']) ? ' nav-active' : ''  }}" href="{{ $elem['fields']['startpage']['path'] ?? "#" }}">{{$elem['fields']['name']}}</a>
    </li>
@endif