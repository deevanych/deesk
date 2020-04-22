<!doctype html>
<html lang="en">
@include('layout.head')
<body>
<div id="app">
    @include('layout.header')
    <section class="container">
        <router-view></router-view>
    </section>
</div>
@include('layout.assets')
</body>
</html>
