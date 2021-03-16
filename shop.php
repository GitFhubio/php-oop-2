<?php
class Product{
	protected $model;
	protected $shippingTime = 3;
	protected $price;
	protected $prime;
	public function __construct(string $model,float $price,bool $prime){
		$this->price=$price;
		$this->model=$model;
		$this->prime=$prime;
	}
	public function getModel(){
		return $this->model;
	}
  public function getPrice(){
		return $this->price;
	}
	public function getPrime(){
	 return $this->prime;
	}
	 public function setShipping($shippingTime){
			 $this->shippingTime=$shippingTime;
	 }
}

class Elettronica extends Product{
protected $memory='none';
protected $processor='none';
public function setElettronica($memory,$processor){
	$this->memory=$memory;
	$this->processor=$processor;
}
}
class Benessere extends Product{
 protected $type;
 protected $genre;
 public function setBenessere($type,$genre){
	 $this->type=$type;
	 $this->genre=$genre;
 }
}

class Clothes extends Product{
protected $type;
protected $genre;
public function setClothes($type,$genre){
	$this->type=$type;
	$this->genre=$genre;
}
}

class VideoGame extends Elettronica{

}

class Pc extends Elettronica{

}

class Buyer extends CreditCard {
protected $prime;
protected $name;
protected $acquisti=[];
protected $surname;
protected $address;
protected $phone_number;
public function __construct($cardnumber,$name,$surname,$address,$phone_number,$prime){
	$this->name=$name;
 $this->prime=$prime;
	$this->cardnumber=$cardnumber;
   $this->surname=$surname;
	 $this->address=$address;
	 $this->phone_number=$phone_number;
}
public function buyProduct(CreditCard $creditcard,Product $product){
if($product->getPrice()<$creditcard->amount){
	$this->acquisti[]=$product;
	$creditcard->setAmount($creditcard->amount - $product->getPrice());
}
if ($product->getPrime() == true && $this->prime == true) {
		$product->setShipping(1);
}
}
public function showAcquisti(){
	return $this->acquisti;
}
public function getName(){
	return $this->name;
}
public function getPrime(){
return $this->prime;
}
}

class CreditCard{
protected $cardnumber;
protected $expirationdate;
protected $amount;
public function __construct(float $amount,int $expirationdate,int $cardnumber){
	$this->amount=$amount;
	$this->cardnumber=$cardnumber;
	$this->expirationdate=$expirationdate;
	if (!$this->isValid()){
		throw new Exception('La carta numero '.$cardnumber.' è scaduta');
	}
}
public function isValid(){
return $this->expirationdate>2021;
}
public function setAmount($amount){
$this->amount=$amount;
}
public function getAmount(){
	return $this->amount;
}
}

$notebook= new Pc('asus 354',700.45,true);
$cremaviso = new Benessere('avene repair',15,true);
$cremaviso->setBenessere('crema','donna');
$pigiama = new Clothes('pigiama',18,true);
$pigiama->setClothes('pigiama','uomo');
$gta= new VideoGame('gta5',60,false);
$creditcard1=new CreditCard(100,2033,5050550503);
$compratore1 = new Buyer(5050550503,'Pippo','Baudo','Via della pace,8',3443434331,true);
$creditcard2=new CreditCard(250,2024,5050550888);
$compratore2 = new Buyer(5050550888,'Nancy','Baudo','Via degli ulivi,22',3498687676,true);
$creditcard3=new CreditCard(1000,2033,5050550666);
$compratore3 = new Buyer(5050550666,'Raffaele','Auriemma','Via della morte,4',3443376432,true);

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
try{
$creditcard4=new CreditCard(1000,2000,88888888);
}catch(Exception $error){
echo $error->getMessage() ."<br>";
}
echo "Il credito residuo della prima carta dopo l'acquisto è di " . $creditcard1->getAmount() . " euro <br>";
echo "Il credito residuo della seconda carta dopo l'acquisto è di " . $creditcard2->getAmount() . " euro <br>";
echo "Il credito residuo della terza carta dopo l'acquisto è di " . $creditcard3->getAmount() . " euro <br>";
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
