<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="api-base-url" content="{{ url('/api') }}"/>
    <title>Converter</title>
    <link href="{{ asset('') }}dist/css/style.min.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        
        <converter-component></converter-component>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>