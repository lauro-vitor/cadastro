<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <style>
        body{
            margin-top: 20px;
        }
    </style>
    <title>Document</title>
</head>
<body>
 
    <div class="container">
        @component('components.navbar', ['current' => $current])
        @endcomponent
        <main role="main">
            @hasSection ('body')
                @yield('body')               
            @endif
        </main>
    </div>
    <script src="{{asset('js/app.js')}}" type="text/javascript"></script>
    @hasSection ('javascript')
        @yield('javascript')
    @endif
</body>
</html>