<?php
class Shop {
  protected $name;
  protected $website;
  protected $location;

  public function __construct(string $name, string $website,string $location) {
    $this ->name = $name;
    $this ->website = $website;
    $this ->location = $location;
  }

  public function getName() {
    return $this ->name;
  }

  public function getWebsite() {
    return $this ->website;
  }

  public function getLocation() {
    return $this ->location;
  }
}

class Product{
  private $id;
  protected $model;
  protected $shippingTime = 3;
  protected $price;
  protected $prime;
  public function __construct(int $id,string $model,float $price,bool $prime){
    $this->id=$id;
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
  public function getId(){
    return $this->id;
  }
  public function setShipping(int $shippingTime){
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
  protected $format;
  protected $condition;
  protected $publisher;
  public function setVideoGame($format,$condition,$publisher){
    $this->format=$format;
    $this->condition=$condition;
    $this->publisher=$publisher;
  }
}

class Pc extends Elettronica{
  protected $screen;
  protected $brand;
  protected $type;

  public function setPc($type,$brand,$screen){
    $this->brand=$brand;
    $this->screen=$screen;
    $this->type=$type;
  }
}

class Buyer extends CreditCard {
  private $id;
  protected  $cards=[];
  protected $prime;
  protected $name;
  protected $birth_date;
  protected $acquisti=[];
  protected $surname;
  protected $address;
  protected $phone_number;
  public function __construct(int $id,string $name,string $surname,string $address,string $birth_date,int $phone_number,bool $prime){
    $this->id=$id;
    $this->name=$name;
    $this->birth_date=$birth_date;
    $this->prime=$prime;
    $this->cardnumber=$cardnumber;
    $this->surname=$surname;
    $this->address=$address;
    $this->phone_number=$phone_number;
  }
  public function addCard($card) {
    if ($card instanceof CreditCard) {
      $this -> cards[] = $card;
    } else {
      throw new Exception('La carta non è valida');
    }
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
  public function getId(){
    return $this->id;
  }
  public function getBirthDate(){
    return $this->birth_date;
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


// Creo prodotti

$notebook= new Pc(1,'asus 354',700.45,true);
$cremaviso = new Benessere(2,'avene repair',15,true);
$cremaviso->setBenessere('crema','donna');
$pigiama = new Clothes(3,'pigiama',18,true);
$pigiama->setClothes('pigiama','uomo');
$gta= new VideoGame(4,'gta5',60,false);

// Creo clienti con carte di credito

$creditcard1=new CreditCard(100,2033,5050550503);
$compratore1 = new Buyer(1,'Pippo','Baudo','Via della pace,8','06-10-90',3443434331,true);
$creditcard2=new CreditCard(250,2024,5050550888);
$compratore2 = new Buyer(2,'Nancy','Brilli','Via degli ulivi,22','28-03-94',3728687676,true);
$creditcard3=new CreditCard(1000,2033,5050550666);
$compratore3 = new Buyer(3,'Raffaele','Auriemma','Via della morte,4','04-02-83',3443376432,true);
$compratore4 = new Buyer(4,'Enzo','Miccio','Via degli Aureli,15','23-09-67',3943676873,true);
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
try{
  $compratore1->addCard('FlavioInsinna');
}catch(Exception $error){
  echo $error->getMessage() ."<br>";
}

echo "Il credito residuo della prima carta dopo l'acquisto è di " . $creditcard1->getAmount() . " euro <br>";
echo "Il credito residuo della seconda carta dopo l'acquisto è di " . $creditcard2->getAmount() . " euro <br>";
echo "Il credito residuo della terza carta dopo l'acquisto è di " . $creditcard3->getAmount() . " euro <br>";
// print_r($compratore3->showAcquisti());
$compratoriteorici=[$compratore1,$compratore2,$compratore3,$compratore4];
foreach ($compratoriteorici as $compratore) {

  if(count($compratore->showAcquisti())>0){
    echo $compratore->getName(). " ha effettuato acquisti <br>";
  } else{
    echo $compratore->getName(). " non ha effettuato acquisti <br>";
  }
}
$compratorieffettivi=[$compratore1,$compratore2,$compratore3];
foreach ($compratorieffettivi as $compratore) {
  foreach ($compratore->showAcquisti() as $acquisto) {
    echo $compratore->getName() ." ha acquistato ".$acquisto->getModel()."<br>";
  }
}
