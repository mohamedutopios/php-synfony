<?php
require_once "Person.php";
require_once "Model/Car.php";
use Model\Car as IhabCar;

$p = new Person("ihab", "abadi");

echo $p->getFirstname();

$p->SayHello();
echo "\n";
echo $p;

$p(36);
$p(23);

$c = new IhabCar();