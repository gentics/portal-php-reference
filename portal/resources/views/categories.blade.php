@if (isset($elem['fields']['name']) && $elem['schema']['name'] = 'portalphp_folder')
    <li class="nav-item active">
        <a class="nav-link" href="{{$elem['path']}}">{{$elem['fields']['name']}}</a>
    </li>
@endif