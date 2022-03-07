<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @stack('script')
</head>
<body>
    <h1>Messages</h1>
    @yield('content')
    <center><h5>Yadhu Nandan</h5></center>
</body>
</html>
