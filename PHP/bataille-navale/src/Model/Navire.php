<?php 

namespace App\Model;

class Navire {
    
    private $taille;
    private $cases;
    
    public function __construct(private string $type, private string $orientation, private array $positionDebut) {
        // Initialisation de la taille en fonction du type
        $this->definirTaille();
        // Génération des cases occupées par le navire
        $this->genererCases();
    }

    public function getCases() {
        return $this->cases;
    }
    
    private function definirTaille() {
        // Exemple simple de définition de taille basée sur le type
        $this->taille = match($this->type) {
            'Destroyer' => 2,
            'Sous-marin' => 3,
            'Croiseur' => 4,
            'Porte-avion' => 5,
            default => 3,
        };
    }
    
    private function genererCases() {
        $this->cases = [];
        
        
        $x = $this->positionDebut["x"];
        $y = $this->positionDebut["y"];
        for ($i = 0; $i < $this->taille; $i++) {
            if ($this->orientation === 'H') {
                $this->cases[] = [$x + $i, $y];
            } else { // 'V'
                $this->cases[] = [$x, $y + $i];
            }
        }
    }

}