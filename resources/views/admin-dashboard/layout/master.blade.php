<!DOCTYPE html>
<html lang="en">
<head>
    <title>Star Admin Pro Laravel Dashboard Template</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="_token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

    <!-- plugin css -->
{!! Html::style('/assets/plugins/@mdi/font/css/materialdesignicons.min.css') !!}
{!! Html::style('/assets/plugins/perfect-scrollbar/perfect-scrollbar.css') !!}
{!! Html::style('/css/datatables.css') !!}

<!-- end plugin css -->

@stack('plugin-styles')

<!-- common css -->
{!! Html::style('css/admin-dashboard.css') !!}
{!! Html::style('/css/toastr.css') !!}
<!-- end common css -->

    @stack('style')
</head>
<body data-base-url="{{url('/')}}">

<div class="container-scroller" id="app">
    @include('admin-dashboard.layout.header')
    <div class="container-fluid page-body-wrapper">
        @include('admin-dashboard.layout.sidebar')
        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
            </div>
            @include('admin-dashboard.layout.footer')
        </div>
    </div>
</div>

<!-- base js -->
{!! Html::script('js/admin-dashboard.js') !!}
{!! Html::script('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') !!}
{!! Html::script('assets/js/toastr.min.js') !!}
<!-- end base js -->

{{--notification handler--}}

<script>
    @if(session()->has('message'))
    let type = '{{ session()->get('alert-type', 'info') }}';
    switch (type) {
        case 'info':
            toastr.info("{{ session()->get('message') }}");
            break;
        case 'success':
            toastr.success("{{ session()->get('message') }}");
            break;
        case 'error':
            toastr.error("{{ session()->get('message') }}");
            break;
        case 'warning':
            toastr.warning("{{ session()->get('message') }}");
            break;
    }
    @endif
</script>


<!-- plugin js -->
@stack('plugin-scripts')
<!-- end plugin js -->

<!-- common js -->
{!! Html::script('assets/js/off-canvas.js') !!}
{!! Html::script('assets/js/hoverable-collapse.js') !!}
{!! Html::script('assets/js/misc.js') !!}
{!! Html::script('assets/js/settings.js') !!}
{!! Html::script('assets/js/todolist.js') !!}
{!! Html::script('/js/scripts.js') !!}
<!-- end common js -->



@stack('custom-scripts')
</body>
{!! Html::script('assets/js/jquery-3.3.1.js') !!}
{!! Html::script('assets/js/datatables.js') !!}




<!-- end used js -->
</html>
