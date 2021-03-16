<?php

$current_year =(int)date('Y');

class Product{
	protected $model;
	protected $price;
	public function __construct(string $model,float $price){
		$this->price=$price;
		$this->model=$model;
	}
	public function getModel(){
		return $this->model;
	}
  public function getPrice(){
		return $this->price;
	}
}

class Elettronica extends Product{
}
class Benessere extends Product{

}

class Clothes extends Product{

}

class VideoGame extends Elettronica{

}

class Pc extends Elettronica{

}

class Buyer extends CreditCard {
protected $name;
protected $amount;
protected $expirationdate;
protected $acquisti=[];
protected $surname;
protected $address;
protected $phone_number;
public function __construct($name,$surname,$address,$phone_number){
	$this->name=$name;
   $this->surname=$surname;
	 $this->address=$address;
	 $this->phone_number=$phone_number;
}
public function buyProduct($expirationdate,$amount,Product $product){
	if($expirationdate>$current_year && $amount>$product->getPrice()){
	$this->acquisti[]=$product;
}}
public function showAcquisti(){
	return $this->acquisti;
}

}

class CreditCard{
protected $expirationdate;
protected $amount;
public function __construct($amount,$expirationdate){
	$this->amount=$amount;
	$this->expirationdate=$espirationdate;
}
}

$notebook= new Pc('asus 354',700.45);
$cremaviso = new Benessere('avene repair',15);
$pigiama = new Clothes('pigiama',18);
$gta= new VideoGame('gta5',60);
$compratore1 = new Buyer('Pippo','Baudo','Via della pace,8',3443434331);

$compratore1->buyProduct(2033,150,$gta);

print_r($compratore1->showAcquisti());
