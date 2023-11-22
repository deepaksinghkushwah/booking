<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title')</title>
        <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
  
        <link href="{{ asset('/css/theme.min.css') }}" rel="stylesheet">
              <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-5-vertical-tabs@2.0.0/dist/b5vtabs.min.css"
    integrity="sha384-AsoWNxsuu73eGp2MPWHa77155fyqP9rueKOeG4t2d/AD4eyBqL20TClzfbAkrul4"
    crossorigin="anonymous"
/>
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">        
    </head>
    <body>        
        <div class="container">        
            @yield('content')
        </div>                
    </body>
</html>
