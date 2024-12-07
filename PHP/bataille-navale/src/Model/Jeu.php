<?php 

namespace App\Model;

class Jeu {
    
    private $etat;
    private $vainqueur;
    private $quiJoue;
    public function __construct(private Joueur $joueur1, private Joueur $joueur2) 
    {
        $this->etat = "en cours";
        $this->quiJoue = $joueur1;
        
    }

    public function getJoueur1() 
    {
        return $this->joueur1;
    }

    public function getJoueur2() 
    {
        return $this->joueur2;
    }

    public function getEtat() 
    {
        return $this->etat;
    }

    public function jouer(int $x, int $y): bool {
        if ($this->etat !== "en cours") {
            return false; 
        }
    
        
        $grilleAdverse = ($this->quiJoue === $this->joueur1) ? $this->joueur2->getGrille() : $this->joueur1->getGrille();
        if (!$grilleAdverse->estTouchee($x, $y)) {
            return false; 
        }
    
        
        $coupReussi = $grilleAdverse->enregistrerTir($x, $y);
        
        
        if ($grilleAdverse->tousNaviresCoules()) {
            $this->etat = "terminé";
            $this->vainqueur = $this->quiJoue;
        } else {
            
            $this->quiJoue = ($this->quiJoue === $this->joueur1) ? $this->joueur2 : $this->joueur1;
        }
    
        return $coupReussi;
    }
    public function getVainqueur() 
    {
        return $this->vainqueur;
    }
}
