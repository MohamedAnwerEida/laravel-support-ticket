<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>{{ config('app.name', 'Laravel') }}</title>
        
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('font-awesome-4.7.0/css/font-awesome.css') }}" rel="stylesheet">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font: 14px "JF Flat Regular",tahoma;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 38px;
                margin-bottom: 40px;
            }
        </style>
    </head>
    <body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="error-template">
                    <h1>404</h1>
                    <h2>The page you are requesting does not exist.</h2>
                    <p class="error-details">
                        The page may have been deleted or you are not authorized to access this page.
                    </p>
                    <div class="error-actions">
                        <a href="{{ asset('/') }}" class="btn btn-primary"><span class="glyphicon glyphicon-home"></span>
                       the main page</a>
                        <a href="{{ asset('/') }}contact_us" class="btn btn-default"><span class="glyphicon glyphicon-envelope"></span> call us </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </body>
</html>
