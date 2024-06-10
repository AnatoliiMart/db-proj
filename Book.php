<?php
class Book
{
  public int $id;
  public string $title;
  public int $price;
  public $created_at;

  function getPrice()
  {
    return "$$this->price";
  }
}
