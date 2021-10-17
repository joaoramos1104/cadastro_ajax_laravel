<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.css') }}">
    <script src=" {{ asset('js/bootstrap/bootstrap.js') }}"></script>
    <title>Cadastro</title>
</head>
<body class="mt-4">

    <div class="container p-3">
        @component('component_navbar', ["current" => $current ])
        @endcomponent
        <main role="main">
            @hasSection('body')
                @yield('body')
            @endif
        </main>
    </div>

    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery/jquery-3.6.0.min.js') }}" type="text/javascript"></script>

    @hasSection("javascript")
        @yield('javascript')
    @endif
</body>
</html>
