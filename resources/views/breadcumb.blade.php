<div class="row">
    <div class="login">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="margin-bottom:0px;">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                @if (isset($midBreadCrumb))
                    <li class="breadcrumb-item"><a href="{{ $urlBreadCrumb }}">{{ $midBreadCrumb }}</a></li>
                @else
                @endif
                <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
            </ol>
        </nav>
    </div>
</div>
