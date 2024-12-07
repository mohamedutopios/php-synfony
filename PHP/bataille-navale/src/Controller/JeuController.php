<?php

namespace App\Controller;

use App\Service\JeuService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class JeuController extends AbstractController
{
    private JeuService $jeuService;

    public function __construct(JeuService $jeuService)
    {
        $this->jeuService = $jeuService;
    }

    #[Route('/', name: 'app_jeu', methods: ["GET"])]
    public function index(): Response
    {
        
        
        return $this->render('jeu/index.html.twig', [
            'controller_name' => 'JeuController',
        ]);
    }

    #[Route('/jouer', name: 'app_jeu_jouer_get', methods: ["GET"])]
    public function jouer(): Response
    {
       
        if($this->jeuService->getJeu() == null) {
            $this->jeuService->demarrerJeu(); 
           
            $this->jeuService->placerNaviresAleatoire("joueur 1");
            $this->jeuService->placerNaviresAleatoire("joueur 2");
        }
        
        return $this->render('jeu/jouer.html.twig', [
            'jeu_en_cours' => $this->jeuService->jeuExists(),
            'jeu' => $this->jeuService->getJeu()
        ]);
    }

    #[Route('/jouer', name: 'app_jeu_jouer_post', methods: ["POST"])]
    public function postJouer(Request $request): Response
    {
        $x = $request->request->get('x');
        $y = $request->request->get('y');
        
        if ($x !== null && $y !== null) {
            $this->jeuService->attaquer((int)$x, (int)$y);
        }
        
        return $this->redirectToRoute('app_jeu_jouer_get');
    }
}
