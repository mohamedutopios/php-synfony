<?php
require_once "Hello.php";
class Person {
    use Hello;
    public function __construct(private string $firstname, private string $lastname) {

    }

    public function getFirstname() : string {
        return $this->firstname;
    }

    public function __toString() {
        return $this->firstname . " ".$this->lastname;
    }

    public function __invoke($age) {
        echo "Age ".$age;
    }
}