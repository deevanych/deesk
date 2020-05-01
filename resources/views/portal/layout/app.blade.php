<!doctype html>
<html lang="en">
@include('portal.layout.head')
<body>
<div id="app">
    @include('portal.layout.header')
    <section class="container">
        <router-view></router-view>
    </section>
</div>
@include('portal.layout.assets')
</body>
</html>
