<?php 

namespace App\Model;

class Joueur {
    private $navires;
   
    public function __construct(private string $nom, private Grille $grille) {
        $this->navires = [];
    }

    public function getGrille() 
    {
        return $this->grille;
    }

    public function getNom() {
        return $this->nom;
    }
    
    public function placerNavire($type, $orientation, $positionDebut) {
        
        $navire = new Navire($type, $orientation, $positionDebut);
        $this->navires = [...$this->navires, $navire];
        
        foreach ($navire->getCases() as $case) {
            
            if (!$this->grille->placerNavire($case[0], $case[1], $navire)) {
                throw new \Exception("Placement du navire impossible.");
            }
        }
        
    }
    



}