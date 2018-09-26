<div id="pizzaPlaces" class="flex-center position-ref">
  @if(isset($pizzaPlaces) && count($pizzaPlaces) > 0)
    @foreach ($pizzaPlaces as $pizzaPlace)
      <div class="pizzaPlaceSelection">
        <img height="200" src="{{$pizzaPlace->imageUrl}}"></img>
        <p>name: {{$pizzaPlace->name}}</p>
        <p>address: {{$pizzaPlace->address}}</p>
        <p>rating: {{$pizzaPlace->rating}}</p>
        <a class="links" href="{{$pizzaPlace->menuUrl}}">menu</a>
      </div>
    @endforeach
  @elseif(isset($pizzaPlaces))
    <p>How upsetting! It looks like there are no pizza places in your area. You should consider moving.</p>
  @endif
</div>
