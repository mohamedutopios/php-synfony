<?php 

namespace App\Service;

use App\Model\Jeu;
use App\Model\Joueur;
use App\Model\Grille;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class JeuService 
{
    private Jeu $jeu;
    private SessionInterface $session;

    public function __construct(private RequestStack $request)
    {
        $this->session = $this->request->getSession();
        
    }

    public function getJeu() 
    {
        return $this->session->get("jeu");
    }

    public function demarrerJeu() 
    {
        $joueur1 = new Joueur("joueur 1", new Grille());
        $joueur2 = new Joueur("joueur 2", new Grille());
        $this->jeu = new Jeu($joueur1, $joueur2);
        $this->session->set("jeu", $this->jeu);
    }

    public function attaquer(int $x, int $y): bool 
    {
        $this->jeu = $this->session->get("jeu");
        if ($this->jeu->jouer($x, $y)) {
            $this->session->set("jeu", $this->jeu);
            return true;
        }
        return false;
    }

    public function jeuExists() {
        
        return $this->session->has("jeu");
    }

    public function placerNavire($type, $orientation, $positionDebut, $joueur = "joueur 1")
    {
        if ($joueur === "joueur 1") {
            $this->jeu->getJoueur1()->placerNavire($type, $orientation, $positionDebut);
        } else {
            $this->jeu->getJoueur2()->placerNavire($type, $orientation, $positionDebut);
        }
        $this->session->set("jeu", $this->jeu);
    }

    public function placerNaviresAleatoire($joueur = "joueur 2")
    {
    
        $typesDeNavires = [
        ['type' => 'Porte-avion', 'taille' => 5],
        ['type' => 'Croiseur', 'taille' => 4],
        ['type' => 'Sous-marin', 'taille' => 3]
        ];
        
        $joueurCible = $joueur === "joueur 1" ? $this->jeu->getJoueur1() : $this->jeu->getJoueur2();
        
        $grille = $joueurCible->getGrille();
        
        foreach ($typesDeNavires as $navire) {
            $placementReussi = false;
            
            while (!$placementReussi) {
                $x = rand(0, $grille->getTaille() - 1);
                $y = rand(0, $grille->getTaille() - 1);
                $orientation = rand(0, 1) ? 'H' : 'V';

                $finX = $orientation === 'H' ? $x + $navire['taille'] - 1 : $x;
                $finY = $orientation === 'V' ? $y + $navire['taille'] - 1 : $y;

                if ($finX < $grille->getTaille() && $finY < $grille->getTaille() && $grille->getCases()[$x][$y] !== null) {
                    $joueurCible->placerNavire($navire['type'], $orientation, ['x' => $x, 'y' => $y]);
                    $placementReussi = true;
                }
            }
        }

        $this->session->set("jeu", $this->jeu);
    }


    public function verifierGagnant(): ?Joueur
    {
        return $this->jeu->getVainqueur(); // Supposons que Jeu ait une méthode getVainqueur() qui retourne le joueur gagnant ou null
    }
}
