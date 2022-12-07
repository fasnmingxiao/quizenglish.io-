<!DOCTYPE html>
<html lang="en">
@include('admin.inc.head')

<body class="layout-light side-menu overlayScroll">
    <div class="mobile-search">
        <form class="search-form">
            <span data-feather="search"></span>
            <input class="form-control mr-sm-2 box-shadow-none" type="text" placeholder="Search...">
        </form>
    </div>
    @include('admin.inc.header')
    <main class="main-content">
        @include('admin.inc.sidebar')
        @yield('content')
        @include('admin.inc.footer')
    </main>

    <div id="overlayer">
        <span class="loader-overlay">
            <div class="atbd-spin-dots spin-lg">
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
            </div>
        </span>
    </div>
   @include('admin.inc.scripts')
</body>

</html>
