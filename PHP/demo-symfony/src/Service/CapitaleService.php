<?php
namespace App\Service;

use SessionHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CapitaleService implements CapitaleInterface {

    private Request $request;
    public  function __construct(private SessionHandlerInterface $session, private RequestStack $requestStack) {
        $request = $this->requestStack->getCurrentRequest();
    }

    private array $pays = ["france", "belgique", "maroc", "portugal"];
    private array $reponses = ["paris", "bruxelles", "rabat", "lisbonne"];


    public function paysAleatoire(): string {
        return $this->pays[rand(0, count($this->pays)-1)];
    }

    public function testPays(string $pays, string $reponse): string {
        $indexPays = array_search($pays, $this->pays); 
        if($indexPays >= 0 && $indexPays !== false) {
            if($reponse == $this->reponses[$indexPays]) {
                $message = "Bravo";
            } else {
                $message = "Mauvaise réponse";
            }   
        } else {
            $message = "Pas de pays $pays dans la liste";
        }
        return $message;
    }
}