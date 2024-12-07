<?php

namespace App\Model;

class Grille {
   
    private $cases;
    
    public function __construct(private int $taille = 12)
    {
        $this->initialiserCases();
    }

    public function getTaille() {
        return $this->taille;
    }

    private function initialiserCases() 
    {
        $this->cases = [];
        for($x = 0; $x < $this->taille; $x++) {
            for($y = 0; $y < $this->taille; $y++) {
                //array_push($this->cases, new Cellule());
                $this->cases[$x][$y] = new Cellule($x,$y);
            }
        }
    }

    public function estTouchee(int $x, int $y): bool {
        return $this->cases[$x][$y]->estTouchee();
    }

    public function getCases() {
        return $this->cases;
    }
    
    public function enregistrerTir(int $x, int $y): bool {
        if ($this->cases[$x][$y]->estTouchee()) {
            // La case a déjà été touchée
            return false;
        }
    
        $this->cases[$x][$y]->toucher();
        return true;
    }

    public function placerNavire($x, $y, $navire) 
    {
        $this->cases[$x][$y]->setNavire($navire);
        return true;
    }

    public function tousNaviresCoules() : bool
    {
        $test = true;
        foreach($this->cases as $cellule) {
            if(!$cellule->estTouchee()) {
                $test = false;
                break;
            }
        }
        return $test;
    }

    public function peutPlacerNavire(int $taille, string $orientation, array $positionDebut): bool {
        $xDebut = $positionDebut['x'];
        $yDebut = $positionDebut['y'];

        for ($i = 0; $i < $taille; $i++) {
            $x = $xDebut + ($orientation === 'H' ? $i : 0);
            $y = $yDebut + ($orientation === 'V' ? $i : 0);

            if ($x >= $this->taille || $y >= $this->taille) {
                return false; 
            }

            
            if ($this->cases[$x][$y]->estOccupee()) {
                return false; 
            }
        }

        return true; 
    }
}