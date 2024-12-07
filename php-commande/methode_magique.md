Les **méthodes magiques** en PHP sont des méthodes spéciales qui commencent par deux underscores (`__`) et qui permettent de personnaliser le comportement des objets. Voici des démonstrations pour les méthodes magiques les plus couramment utilisées.

---

### **1. `__construct` : Le constructeur**
Appelé automatiquement lors de la création d'un objet.

#### Exemple :
```php
<?php
class Person {
    private $name;

    public function __construct($name) {
        $this->name = $name;
        echo "Un objet Person a été créé pour $name.\n";
    }
}

$person = new Person("Alice");
```

**Sortie** :
```
Un objet Person a été créé pour Alice.
```

---

### **2. `__destruct` : Le destructeur**
Appelé automatiquement lorsqu'un objet est détruit ou que le script termine.

#### Exemple :
```php
<?php
class FileHandler {
    private $file;

    public function __construct($filename) {
        $this->file = fopen($filename, "w");
        echo "Fichier ouvert.\n";
    }

    public function __destruct() {
        fclose($this->file);
        echo "Fichier fermé.\n";
    }
}

$handler = new FileHandler("test.txt");
```

**Sortie** :
```
Fichier ouvert.
Fichier fermé.
```

---

### **3. `__toString` : Conversion en chaîne**
Appelé lorsqu'un objet est utilisé comme une chaîne de caractères.

#### Exemple :
```php
<?php
class Person {
    private $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function __toString() {
        return "Personne : $this->name";
    }
}

$person = new Person("Alice");
echo $person; // Appelle __toString()
```

**Sortie** :
```
Personne : Alice
```

---

### **4. `__get` et `__set` : Accès dynamique aux propriétés**
- `__get` : Appelé lorsqu'une propriété inaccessible ou inexistante est lue.
- `__set` : Appelé lorsqu'une propriété inaccessible ou inexistante est modifiée.

#### Exemple :
```php
<?php
class Magic {
    private $data = [];

    public function __get($name) {
        return $this->data[$name] ?? "Propriété '$name' non définie.";
    }

    public function __set($name, $value) {
        $this->data[$name] = $value;
        echo "Propriété '$name' définie à $value.\n";
    }
}

$magic = new Magic();
$magic->name = "Alice"; // Appelle __set()
echo $magic->name . "\n"; // Appelle __get()
echo $magic->age; // Propriété inexistante
```

**Sortie** :
```
Propriété 'name' définie à Alice.
Alice
Propriété 'age' non définie.
```

---

### **5. `__isset` et `__unset` : Gestion des propriétés**
- `__isset` : Appelé pour vérifier l'existence d'une propriété avec `isset`.
- `__unset` : Appelé pour détruire une propriété.

#### Exemple :
```php
<?php
class Magic {
    private $data = [];

    public function __isset($name) {
        return isset($this->data[$name]);
    }

    public function __unset($name) {
        unset($this->data[$name]);
        echo "Propriété '$name' supprimée.\n";
    }

    public function __set($name, $value) {
        $this->data[$name] = $value;
    }
}

$magic = new Magic();
$magic->name = "Alice";
echo isset($magic->name) ? "La propriété existe.\n" : "Propriété inexistante.\n"; // Appelle __isset()
unset($magic->name); // Appelle __unset()
```

**Sortie** :
```
La propriété existe.
Propriété 'name' supprimée.
```

---

### **6. `__call` et `__callStatic` : Appel dynamique de méthodes**
- `__call` : Appelé lorsqu'une méthode inaccessible ou inexistante est invoquée sur un objet.
- `__callStatic` : Appelé lorsqu'une méthode statique inaccessible ou inexistante est invoquée.

#### Exemple :
```php
<?php
class Magic {
    public function __call($name, $arguments) {
        echo "Méthode '$name' appelée avec les arguments : " . implode(", ", $arguments) . "\n";
    }

    public static function __callStatic($name, $arguments) {
        echo "Méthode statique '$name' appelée avec les arguments : " . implode(", ", $arguments) . "\n";
    }
}

$magic = new Magic();
$magic->dynamicMethod("arg1", "arg2"); // Appelle __call()
Magic::dynamicStaticMethod("arg1", "arg2"); // Appelle __callStatic()
```

**Sortie** :
```
Méthode 'dynamicMethod' appelée avec les arguments : arg1, arg2
Méthode statique 'dynamicStaticMethod' appelée avec les arguments : arg1, arg2
```

---

### **7. `__clone` : Clonage d'objet**
Appelé lors du clonage d'un objet avec `clone`.

#### Exemple :
```php
<?php
class Person {
    public $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function __clone() {
        echo "Clonage de l'objet.\n";
        $this->name = "Cloned " . $this->name;
    }
}

$person1 = new Person("Alice");
$person2 = clone $person1; // Appelle __clone()

echo $person1->name . "\n"; // Alice
echo $person2->name . "\n"; // Cloned Alice
```

**Sortie** :
```
Clonage de l'objet.
Alice
Cloned Alice
```

---

### **8. `__invoke` : Appel d'un objet comme une fonction**
Permet de définir un comportement lorsqu'un objet est invoqué comme une fonction.

#### Exemple :
```php
<?php
class CallableClass {
    public function __invoke($name) {
        return "Bonjour, $name !";
    }
}

$callable = new CallableClass();
echo $callable("Alice"); // Appelle __invoke()
```

**Sortie** :
```
Bonjour, Alice !
```

---

### **9. `__sleep` et `__wakeup` : Sérialisation**
- `__sleep` : Appelé avant la sérialisation pour préparer l'objet.
- `__wakeup` : Appelé lors de la désérialisation pour réinitialiser l'objet.

#### Exemple :
```php
<?php
class SerializableClass {
    private $name;
    private $age;

    public function __construct($name, $age) {
        $this->name = $name;
        $this->age = $age;
    }

    public function __sleep() {
        return ['name']; // Spécifie les propriétés à sérialiser
    }

    public function __wakeup() {
        echo "Objet désérialisé.\n";
    }
}

$object = new SerializableClass("Alice", 30);
$serialized = serialize($object);
echo $serialized . "\n";

$unserialized = unserialize($serialized); // Appelle __wakeup()
```

**Sortie** :
```
O:18:"SerializableClass":1:{s:4:"name";s:5:"Alice";}
Objet désérialisé.
```

---

### **10. `__debugInfo` : Personnalisation du débogage**
Permet de personnaliser les informations retournées par `var_dump`.

#### Exemple :
```php
<?php
class Person {
    private $name;
    private $age;

    public function __construct($name, $age) {
        $this->name = $name;
        $this->age = $age;
    }

    public function __debugInfo() {
        return [
            'nom' => $this->name,
            'âge' => $this->age
        ];
    }
}

$person = new Person("Alice", 30);
var_dump($person); // Appelle __debugInfo()
```

**Sortie** :
```
array(2) {
  ["nom"]=>
  string(5) "Alice"
  ["âge"]=>
  int(30)
}
```

---

Ces démonstrations montrent comment exploiter pleinement les méthodes magiques en PHP pour rendre vos classes plus dynamiques et flexibles. Si vous voulez approfondir l'une d'elles, n'hésitez pas à demander ! 😊