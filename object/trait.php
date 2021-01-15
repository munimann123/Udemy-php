<?php

trait ProductTrait{
  
  public function getProduct(){
    echo 'プロダクト';
  }

}

trait NewsTrait{

  public function getNews(){
    echo 'ニュースです';
  }

}

class Product{
  use ProductTrait;
  use NewsTrait;

  public function getInformation(){
    echo 'クラスです';
  }


  // public function getNews(){
  //   echo 'クラスニュースです';
  // }
}

$instance = new Product;

$instance->getInformation();
echo '<br>';
$instance->getProduct();
echo '<br>';
$instance->getNews();
echo '<br>';
