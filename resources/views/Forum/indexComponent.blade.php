@php
    $texto = "";
@endphp

<div class="searchBar row">
    <form action="{{url('forum/search/')}}" method="GET" role="form">
        <div class="col-lg-8">
            <span class="noteText"><b>Nota</b>: La b&uacute;squeda será global *</span>
        </div>
        <div class="col-lg-4 nopadding">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Buscar..." name="search">
                <span class="input-group-btn">
                        <input type="submit" value="Buscar" class="btn btn-primary-ulat">
                    </span>
            </div>
        </div>
    </form>
</div>
<div class="index">
    <ul>
        <li><a href="{{ route('forum') }}"><i class="fas fa-home"></i></a></li>
        @if (isset($links)) @foreach ($links as $index => $link)
        <li><a href="{{ $href[$index] }}"> {{$link}} </a></li>
        @endforeach @endif
    </ul>
</div>