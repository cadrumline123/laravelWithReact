<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\PizzaPlace;

class ZomatoAPiProvider extends ServiceProvider
{
    //cuisineId 82 represents pizza
    //$cityId 1051 represents oklahoma city
    public static function getPizzaPlacesInArea($entityId = 1051, $entityType = "city", $mileRadius = 10, $cuisineId = 82){
      $response = self::callZomato($entityId, $entityType, $mileRadius, $cuisineId);

      if($response->getStatusCode() == 200){
        return self::generatePizzaPlaces($response->getBody());
      } else {
        //log here
        return [];
      }
    }

    private static function callZomato($entityId, $entityType, $mileRadius, $cuisineId){
      $meters = $mileRadius * 1609; //math
      
      //// TODO: Should be moved to a config or something
      $requestUrl = "https://developers.zomato.com/api/v2.1/search";

      $client = new \GuzzleHttp\Client();
      $headers = ['Accept' => 'application/json', 'user-key' => 'd4f7bd193f51c76df0197b689562476e'];
      $queryStrings = [
        'entity_id' => $entityId,
        'entity_type' => $entityType,
        'count' => '10',
        'radius' => $meters,
        'cuisines' => $cuisineId,
        'sort' => 'rating',
        'order' => 'desc'
      ];

      $response = $client->request('GET', $requestUrl, [
        'query' => $queryStrings,
        'headers' => $headers
      ]);

      return $response;
    }

    private static function generatePizzaPlaces($zomatoJsonResult){
      $decodedJson = json_decode($zomatoJsonResult);
      $pizzaPlaces = [];

      foreach ($decodedJson->restaurants as $restaurant) {
        $pizzaPlace = $restaurant->restaurant;
        $ratingSummary = $pizzaPlace->user_rating;

        //we only want places that have been rated and are above a 0
        if($ratingSummary->rating_text != 'Not rated' && intval($ratingSummary->aggregate_rating) > 0){
          array_push($pizzaPlaces, PizzaPlace::fromZomatoResult($pizzaPlace));
        }
      }

      return $pizzaPlaces;
    }
}
