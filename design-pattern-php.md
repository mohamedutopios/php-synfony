Voici des exemples concrets de **design patterns** en PHP pour les catégories **structurels**, **comportementaux**, et **créationnels**.

---

## **1. Créationnels (Creational)**
Les patterns créationnels se concentrent sur la manière de créer des objets.

### **Exemple : Singleton**
Le **Singleton** garantit qu'une classe n'a qu'une seule instance et fournit un point d'accès global à celle-ci.

```php
<?php
class Singleton {
    private static $instance;

    // Constructeur privé pour empêcher l'instanciation directe
    private function __construct() {}

    public static function getInstance(): Singleton {
        if (self::$instance === null) {
            self::$instance = new Singleton();
        }
        return self::$instance;
    }

    public function doSomething() {
        echo "Singleton actif.\n";
    }
}

// Utilisation
$singleton1 = Singleton::getInstance();
$singleton2 = Singleton::getInstance();

$singleton1->doSomething();

var_dump($singleton1 === $singleton2); // true
```

---

### **Exemple : Factory**
Le **Factory** fournit une méthode pour créer des objets sans spécifier leur classe exacte.

```php
<?php
interface Vehicle {
    public function getType(): string;
}

class Car implements Vehicle {
    public function getType(): string {
        return "Voiture";
    }
}

class Truck implements Vehicle {
    public function getType(): string {
        return "Camion";
    }
}

class VehicleFactory {
    public static function create(string $type): Vehicle {
        return match ($type) {
            'car' => new Car(),
            'truck' => new Truck(),
            default => throw new InvalidArgumentException("Type non supporté"),
        };
    }
}

// Utilisation
$car = VehicleFactory::create('car');
$truck = VehicleFactory::create('truck');

echo $car->getType() . "\n"; // Voiture
echo $truck->getType() . "\n"; // Camion
```

---

## **2. Structurels (Structural)**
Les patterns structurels concernent la composition des classes et des objets.

### **Exemple : Adapter**
L'**Adapter** permet à des classes incompatibles de travailler ensemble en traduisant leurs interfaces.

```php
<?php
interface MediaPlayer {
    public function play($file);
}

class VLCPlayer {
    public function playVLC($file) {
        echo "Lecture du fichier VLC : $file\n";
    }
}

class VLCAdapter implements MediaPlayer {
    private $vlcPlayer;

    public function __construct(VLCPlayer $vlcPlayer) {
        $this->vlcPlayer = $vlcPlayer;
    }

    public function play($file) {
        $this->vlcPlayer->playVLC($file);
    }
}

// Utilisation
$vlcPlayer = new VLCPlayer();
$adapter = new VLCAdapter($vlcPlayer);

$adapter->play("film.vlc"); // Lecture du fichier VLC : film.vlc
```

---

### **Exemple : Decorator**
Le **Decorator** ajoute dynamiquement des fonctionnalités à un objet.

```php
<?php
interface Coffee {
    public function cost(): float;
    public function description(): string;
}

class SimpleCoffee implements Coffee {
    public function cost(): float {
        return 5.0;
    }

    public function description(): string {
        return "Café simple";
    }
}

class MilkDecorator implements Coffee {
    private $coffee;

    public function __construct(Coffee $coffee) {
        $this->coffee = $coffee;
    }

    public function cost(): float {
        return $this->coffee->cost() + 2.0;
    }

    public function description(): string {
        return $this->coffee->description() . ", avec lait";
    }
}

class SugarDecorator implements Coffee {
    private $coffee;

    public function __construct(Coffee $coffee) {
        $this->coffee = $coffee;
    }

    public function cost(): float {
        return $this->coffee->cost() + 1.0;
    }

    public function description(): string {
        return $this->coffee->description() . ", avec sucre";
    }
}

// Utilisation
$coffee = new SimpleCoffee();
$coffee = new MilkDecorator($coffee);
$coffee = new SugarDecorator($coffee);

echo $coffee->description() . "\n"; // Café simple, avec lait, avec sucre
echo $coffee->cost() . "\n"; // 8.0
```

---

## **3. Comportementaux (Behavioral)**
Les patterns comportementaux se concentrent sur les interactions entre objets.

### **Exemple : Strategy**
Le **Strategy** permet de changer dynamiquement l'algorithme utilisé par un objet.

```php
<?php
interface PaymentStrategy {
    public function pay(float $amount): void;
}

class CreditCardPayment implements PaymentStrategy {
    public function pay(float $amount): void {
        echo "Paiement de $amount par carte de crédit.\n";
    }
}

class PayPalPayment implements PaymentStrategy {
    public function pay(float $amount): void {
        echo "Paiement de $amount via PayPal.\n";
    }
}

class ShoppingCart {
    private $strategy;

    public function setPaymentStrategy(PaymentStrategy $strategy): void {
        $this->strategy = $strategy;
    }

    public function checkout(float $amount): void {
        $this->strategy->pay($amount);
    }
}

// Utilisation
$cart = new ShoppingCart();

$cart->setPaymentStrategy(new CreditCardPayment());
$cart->checkout(100); // Paiement de 100 par carte de crédit.

$cart->setPaymentStrategy(new PayPalPayment());
$cart->checkout(200); // Paiement de 200 via PayPal.
```

---

### **Exemple : Observer**
Le **Observer** permet de notifier plusieurs objets lorsqu'un changement d'état se produit dans un objet.

```php
<?php
interface Observer {
    public function update(string $message): void;
}

class EmailNotifier implements Observer {
    public function update(string $message): void {
        echo "Notification par email : $message\n";
    }
}

class SMSNotifier implements Observer {
    public function update(string $message): void {
        echo "Notification par SMS : $message\n";
    }
}

class Subject {
    private $observers = [];
    

    public function attach(Observer $observer): void {
        $this->observers[] = $observer;
    }

    public function notify(string $message): void {
        foreach ($this->observers as $observer) {
            $observer->update($message);
        }
    }
}

// Utilisation
$subject = new Subject();
$subject->attach(new EmailNotifier());
$subject->attach(new SMSNotifier());

$subject->notify("Un nouvel événement s'est produit."); 
// Notification par email : Un nouvel événement s'est produit.
// Notification par SMS : Un nouvel événement s'est produit.
```

---

Ces exemples montrent comment implémenter des patterns créationnels, structurels et comportementaux en PHP. Si vous voulez approfondir ou explorer d'autres patterns, faites-le-moi savoir ! 😊