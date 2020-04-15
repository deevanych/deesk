<!doctype html>
<html lang="en">
@include('layout.head')
<body>
<div id="app">
    @include('layout.header')
    <section class="container">
        @yield('content')
    </section>
</div>
@include('layout.assets')
</body>
</html>
