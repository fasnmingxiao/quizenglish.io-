<!DOCTYPE html>
<html lang="en">
@include('admin.inc.head')

<body>
    <div class="container-fluid position-relative d-flex p-0">
        @include('admin.inc.spinner')
        @include('admin.inc.sidebar')

        @yield('content')
        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    @include('admin.inc.footer')
</body>

</html>
