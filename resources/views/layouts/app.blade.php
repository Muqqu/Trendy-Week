<!DOCTYPE html>
<html lang="en">

@include("layouts.partials.head")
<body>
    <div class="main">
        @include("layouts.partials.nav")
        @yield('content')
        @include("layouts.partials.footer")

    </div>

    @include("layouts.partials.offcanvas")
    
    @include("layouts.partials.scripts")
    @yield('extra-js')
</body>

</html>