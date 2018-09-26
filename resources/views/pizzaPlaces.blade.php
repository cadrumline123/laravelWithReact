<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Your Favorite Pizza Places</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="css/sharedStyles.css" rel="stylesheet" type="text/css">
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

                <div id="pizzaPlaces" class="flex-center position-ref">
                  @if(isset($pizzaPlaces) && count($pizzaPlaces) > 0)
                    @foreach ($pizzaPlaces as $pizzaPlace)
                      <div class="pizzaPlaceSelection">
                        <!-- <img height="200" src="{{$pizzaPlace->imageUrl}}"></img> -->
                        <p>{{$pizzaPlace->name}}</p>
                        <p>{{$pizzaPlace->address}}</p>
                        <p>rating: {{$pizzaPlace->rating}}</p>
                        <a class="links" target="_blank" href="{{$pizzaPlace->menuUrl}}">menu</a>
                      </div>
                    @endforeach
                  @elseif(isset($pizzaPlaces))
                    <p>How upsetting! It looks like there are no pizza places in your area. You should consider moving.</p>
                  @endif
                </div>
            </div>
        </div>
    </body>
</html>
