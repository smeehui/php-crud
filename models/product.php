<?php
class Product {
   public $id;
   public $name;
   public $quantity;
   public $price;
   public $description;
   public $category;

   public function __construct($id,$name,$quantity,$price,$description,$category) {
      $this->id = $id;
      $this->name = $name;
      $this->quantity = $quantity;
      $this->price = $price;
      $this->description = $description;
      $this->category = $category;
   }
}