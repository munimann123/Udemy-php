<?php

class Product{

//アクセス演算子 private(外からアクセスさせない),protected(自分、継承したクラス),public(公開)

//変数
  private $product = [];

//関数

//初回
  function __construct($product){

    $this->product = $product;
  } 

  public function getProduct(){
    echo $this->product;
  }

  public function addProduct($item){
    $this->product .= $item;
  }
//静的
  public static function getStaticProduct($str){
    echo $str;
  }
}

$instance = new Product('テスト');

var_dump($instance);

$instance->getProduct();
echo '<br>';

$instance->addProduct('追加分');
echo '<br>';

$instance->getProduct();
echo '<br>';
//静的(static) クラス名::関数名
Product::getStaticProduct('静的');
echo '<br>';

