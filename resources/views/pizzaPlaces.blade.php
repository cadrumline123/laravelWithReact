<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Your Favorite Pizza Places</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="css/sharedStyles.css?v=1" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
        <div class="navbar-laravel">
            <a href="login">Login</a>
        </div>
        <div class="flex-center position-ref full-height">
            <!--@if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/pizzaPlaces') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif-->

            <div class="content">
                <div class="title m-b-md">
                    Find Your Favorite Pizza Place!
                </div>
                @component('pizzaParameterSelector')
                @endcomponent


                <div id="pizzaPlaces" class="container" class="flex-center position-ref">
                  @if(isset($pizzaPlaces) && count($pizzaPlaces) > 0)
                    @for ($i = 1; $i <= count($pizzaPlaces); $i++)
                      @if($i % 3 == 1)
                        </div><div class="row">
                      @endif
                      <div class="pizzaPlaceSelection col-sm">
                        <!-- <img height="200" src="{{$pizzaPlaces[$i-1]->imageUrl}}"></img> -->
                        <p>{{$pizzaPlaces[$i-1]->name}}</p>
                        <p>{{$pizzaPlaces[$i-1]->address}}</p>
                        <p>rating: {{$pizzaPlaces[$i-1]->rating}}</p>
                        <a class="links" target="_blank" href="{{$pizzaPlaces[$i-1]->menuUrl}}">menu</a>
                      </div>
                    @endfor
                    </div>
                  @elseif(isset($pizzaPlaces))
                    <p>How upsetting! It looks like there are no pizza places in your area. You should consider moving.</p>
                  @endif
                </div>
            </div>
        </div>
    </body>
</html>
