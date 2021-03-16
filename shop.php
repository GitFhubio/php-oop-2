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
public function buyProduct(CreditCard $creditcard,Product $product){
if($product->getPrice()<$creditcard->amount){
	$this->acquisti[]=$product;
}
}
public function showAcquisti(){
	return $this->acquisti;
}

}

class CreditCard{
protected $expirationdate;
public $amount;
public function __construct(float $amount,int $expirationdate){
	$this->amount=$amount;
	$this->expirationdate=$expirationdate;
	if (!$this->isValid()){
		throw new Exception('La carta è scaduta');
	}
}
public function isValid(){
return $this->expirationdate>$current_year;
}
}

$notebook= new Pc('asus 354',700.45);
$cremaviso = new Benessere('avene repair',15);
$pigiama = new Clothes('pigiama',18);
$gta= new VideoGame('gta5',60);
$compratore1 = new Buyer('Pippo','Baudo','Via della pace,8',3443434331);
$creditcard1=new CreditCard(100,2033);
try{
$compratore1->buyProduct($creditcard1,$gta);
}catch(Exception $error){
echo $error->getMessage();
}
print_r($compratore1->showAcquisti());
