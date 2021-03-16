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
public function __construct($cardnumber,$name,$surname,$address,$phone_number){
	$this->name=$name;
	$this->cardnumber=$cardnumber;
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
public function getName(){
	return $this->name;
}

}

class CreditCard{
protected $cardnumber;
protected $expirationdate;
protected $amount;
public function __construct(float $amount,int $expirationdate,int $cardnumber){
	$this->amount=$amount;
	$this->cardnumber;
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
$creditcard1=new CreditCard(100,2033,5050550503);
$compratore1 = new Buyer(5050550503,'Pippo','Baudo','Via della pace,8',3443434331);
$creditcard2=new CreditCard(250,2024,5050550888);
$compratore2 = new Buyer(5050550888,'Nancy','Baudo','Via degli ulivi,22',3498687676);
$creditcard3=new CreditCard(1000,2033,5050550666);
$compratore3 = new Buyer(5050550666,'Raffaele','Auriemma','Via della morte,4',3443376432);

try{
$compratore1->buyProduct($creditcard1,$gta);
}catch(Exception $error){
echo $error->getMessage();
}

// print_r($compratore1->showAcquisti());

try{
$compratore2->buyProduct($creditcard2,$cremaviso);
}catch(Exception $error){
echo $error->getMessage();
}

// print_r($compratore2->showAcquisti());

try{
$compratore3->buyProduct($creditcard3,$pigiama);
}catch(Exception $error){
echo $error->getMessage();
}

// print_r($compratore3->showAcquisti());
$compratori=[$compratore1,$compratore2,$compratore3];
$prodotti=[$cremaviso,$pigiama,$gta];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body>
 <?php foreach ($compratori as $compratore){?>
	 <p><?php echo $compratore->getName() ." ha acquistato: " ?></p>
	 <p><?php print_r($compratore->showAcquisti()) ?></p>
<?php }?>
	</body>
</html>
