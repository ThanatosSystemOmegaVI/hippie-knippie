<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" type="image/png" href="/favicon.png">
    <title>Hippie Knippie</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body>
    <div id="app"></div>
</body>

</html>