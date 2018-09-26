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

    $pizzaPlaces = [];
    $selectedEntityId = json_decode($request->input('citySelector'))->entityId;
    $selectedEntityType = json_decode($request->input('citySelector'))->entityType;
    $selectedMileRadius = intval($request->input('distanceSelector'));

    try {
        $pizzaPlaces = ZomatoAPiProvider::getPizzaPlacesInArea($selectedEntityId, $selectedEntityType, $selectedMileRadius);
    } catch (\Exception $e) {
      //log Here
    }

    return view("pizzaPlaces")->withPizzaPlaces($pizzaPlaces);
  }
}
