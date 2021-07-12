<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- bootstrap  check step step 4--}}
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>



    <title>Ryota</title>

        
        


    </head>
    <body>
        @include('inc.navbar')
        
        <div class="container mt-5 mb-5">
            @include('inc.message')
            @yield('content')

        </div>
        @include('inc.footer')
        
        <script> CKEDITOR.replace( 'editor1' ); </script>
        <script> CKEDITOR.replace( 'editor2' ); </script>
        <script> CKEDITOR.replace( 'editor3' ); </script>


    </body>
</html>
