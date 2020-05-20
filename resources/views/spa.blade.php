<!doctype html>
<html lang="{{ app()->getLocale() }}"> 
    <head>
        <meta charset="utf-8"> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <meta name="csrf-token" content="{{ csrf_token()}}"> 
    
        <title>Sexy Auth</title>

        <!-- Fonts -->
        <link href="https://bootswatch.com/4/litera/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"> 
        <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet"> 
        <link href="https://unpkg.com/nprogress@0.2.0/nprogress.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
        <link  href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.4.3/cropper.css" rel="stylesheet">
    </head>

    <body>
        
        <div id="app"> 
            <router-view></router-view>
        </div>
        
        <script>window.laravel = { csrfToken: '{{ csrf_token() }}' }</script>
        <script src="{{ asset('js/app.js') }}"></script>

        <script src="https://unpkg.com/nprogress@0.2.0/nprogress.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.4.3/cropper.js"></script>

    </body>
</html>