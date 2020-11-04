@include('larablend::includes.head')

<body class="">
<div class="wrapper ">
    @include('larablend::includes.sidebar')
    <div class="main-panel">
        @include('larablend::includes.navbar')
        <div class="content">
            @yield('content')
        </div>
        @include('larablend::includes.footer')
    </div>
</div>
@include('larablend::includes.foot')
@yield('modals')
<script>
    @yield('custom-inline-script')
</script>
</body>

</html>
