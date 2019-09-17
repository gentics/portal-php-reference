    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                @foreach(Helper::sortByNavSortOrder($rootNode['children']['elements'] ?? []) as $elem)
                    @include('navelement', ['node' => $node, 'elem' => $elem])
                @endforeach
            </ul>
            <form action="{{ route('search') }}" method="get" class="form-inline my-2 my-lg-0">
                <input class="form-control form-search mr-sm-2" type="search" name="q" list="autocompleteresults" id="searchInput" autocomplete="off" placeholder="Search" aria-label="Search" value="{{ $search['query']['q'] ?? "" }}">
                <datalist id="autocompleteresults"></datalist>
            </form>
        </div>
    </nav>
