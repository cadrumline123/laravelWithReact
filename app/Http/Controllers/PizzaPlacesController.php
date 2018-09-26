<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PizzaPlace;
use App\Providers\ZomatoAPiProvider;

class PizzaPlacesController extends Controller
{
  public function show()
  {
    return view("pizzaPlaces");
  }

  public function showPizzaPlaces(Request $request)
  {
    // $pizzaPlaces = [
    //   new PizzaPlace("Pizzaz", "1234 Main St", 5, "images/Tulips.jpg", 'images/milky way.htm'),
    //   new PizzaPlace("Howdy Pies", "5678 2nd St", 4, "images/Tulips.jpg", 'images/milky way.htm')
    // ];

    $pizzaPlaces = [];
    //var_dump(json_decode($request->input('citySelector')));
    //$selectedEntityId = 1051;
    //$selectedEntityType = "city";
    $selectedEntityId = json_decode($request->input('citySelector'))->entityId;
    $selectedEntityType = json_decode($request->input('citySelector'))->entityType;
    $selectedMileRadius = $request->input('distanceSelector');

    try {
        $pizzaPlaces = ZomatoAPiProvider::getPizzaPlacesInArea($selectedEntityId, $selectedEntityType, $selectedMileRadius);
    } catch (\Exception $e) {
      //log Here
      var_dump($e);
    }
    //var_dump($pizzaPlaces);
    return view("pizzaPlaces")->withPizzaPlaces($pizzaPlaces);
  }
}
