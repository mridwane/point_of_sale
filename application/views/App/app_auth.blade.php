@php
    $ci =& get_instance(); 
@endphp
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title}}</title>
        @include('App.style')
    </head>
    <body class="hold-transition {{ $style }}-page">
    <div class="flash-data" data-flashdata="<?= $ci->session->flashdata('flash');?>"></div>

    @yield('content')

    {{-- default js --}}
    @include('App.script')
    {{-- js this page --}}
    @yield('javascript')
    </body>
</html>
