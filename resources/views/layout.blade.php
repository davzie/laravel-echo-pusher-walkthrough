<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Commentr</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">

    
    </head>
    <body>
        <div id="app">
            @yield('content')
        </div>

        <script>
            window.Laravel = { csrfToken: '{{ csrf_token() }}' };
        </script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
