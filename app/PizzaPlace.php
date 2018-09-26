<?php

namespace App;

class PizzaPlace
{
    public $name;
    public $address;
    public $rating;
    public $imageUrl;
    public $menuUrl;

    function __construct($name, $address, $rating, $imageUrl, $menu){
      $this->name = $name;
      $this->address = $address;
      $this->rating = $rating;
      $this->imageUrl = $imageUrl;
      $this->menuUrl = $menu;
    }

    public static function fromZomatoResult($zomatoJsonResult){
      return new PizzaPlace(
          $zomatoJsonResult->name,
          $zomatoJsonResult->location->address,
          $zomatoJsonResult->user_rating->aggregate_rating,
          $zomatoJsonResult->photos_url,
          $zomatoJsonResult->menu_url
      );
    }
}
