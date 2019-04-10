@if(Helper::isNotHidden($elem))
    @if(Helper::isFolder($elem))
        @if (isset($elem['fields']['name']))
            <li class="nav-item active">
                <a class="nav-link{{ Helper::isInActivePath($elem, $node) ? ' nav-active' : ''  }}" href="{{ Helper::getUrl($elem) }}">{{ $elem['fields']['name'] }}</a>
            </li>
        @endif
    @endif
@endif