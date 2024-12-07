<?php 

namespace App\Model;

class Cellule {

    
    private ?Navire $navire;  

    public function __construct(private int $x,private int $y,private bool $estTouchee = false)
    {
        
    }

    public function getPosition() {
        //=> retour de la case en "A:1" par exemple
    }

    public function setPosition(string $position) {
        //Convertir la position sous forme "A:1" en x, y
    }

    public function toucher() {
        $this->estTouchee = true;
    }
    
    public function estTouchee(): bool {
        return $this->estTouchee;
    }

    public function setNavire($navire) {
        $this->navire = $navire;
    }

    public function getNavire() 
    {
        return $this->navire;
    }

}