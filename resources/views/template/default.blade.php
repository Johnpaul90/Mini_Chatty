<!Doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>
       Chatty
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
    @include('partials.navigation')
    <div class="container">
        @include('partials.alerts')
        @yield('content')
    </div>

</body>


</html>