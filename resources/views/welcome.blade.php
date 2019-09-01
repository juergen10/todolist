<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TodoList</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">TodoList</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
          </ul>
        </div>
      </nav>
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <div class="title">
              Todo List App
            </div>
          </div>
          <div class="col-md-12">
            <div class="row">
              @if (Route::has('login'))
              @auth
              <div class="col-md-6 text-right">
                <a href="{{ route('home') }}" class="btn btn-success btn-lg">Home</a>
              </div>
              @else
              <div class="col-md-6 text-right">
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg" role="button">Login</a>
              </div>
              @if (Route::has('register'))
              <div class="col-md-6">
                <a href="{{ route('register') }}" class="btn btn-secondary btn-lg" role="button">Register</a>
              </div>
              @endif
              @endauth
              @endif
            </div>
          </div>
        </div>
      </div>
    </body>
</html>
