<?php

namespace App\Controller;

use App\Event\CustomEvent;
use App\Service\CapitaleInterface;
use App\Service\CapitaleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CapitaleController extends AbstractController
{

    // private array $pays = ["france", "belgique", "maroc", "portugal"];
    // private array $reponses = ["paris", "bruxelles", "rabat", "lisbonne"];

    public function __construct(private CapitaleInterface $capitaleService, private EventDispatcher $eventDispatcher)
    {
        
    }

    #[Route('/question', name: 'app_question', methods:["GET"])]
    public function question(): Response
    {
        $this->eventDispatcher->dispatch(new CustomEvent(), CustomEvent::STARTEVENT);
        $p = $this->capitaleService->paysAleatoire();
        return JsonResponse::fromJsonString("{pays: $p}");
    }

    #[Route('/question-html', name: 'app_question_html', methods:["GET"])]
    public function questionHtml(): Response
    {
        $p = $this->capitaleService->paysAleatoire();
        return $this->render('capitale/question.html.twig', ["pays" => $p]);
    }

    #[Route('/reponse/{pays}/{reponse}', name: 'app_reponse', methods:["GET"])]
    public function reponse(string $pays, string $reponse): Response
    {
        $message = $this->capitaleService->testPays($pays, $reponse);
        return JsonResponse::fromJsonString("{message: '$message'}");
    }

    #[Route('/reponse', name: 'app_reponse_body', methods:["POST"])]
    public function reponseWithJsonRequest(Request $request /*request from symfony/httpFoundation*/): Response
    {
        $body = json_decode($request->getContent());
        
        $message = $this->capitaleService->testPays($body->pays, $body->reponse);
        return JsonResponse::fromJsonString("{message: '$message'}");
    }



    #[Route('/reponse-html', name: 'app_reponse_html', methods:["POST"])]
    public function reponseHtml(Request $request /*request from symfony/httpFoundation*/): Response
    {
        
        $pays = $request->get("pays");
        $reponse = $request->get("reponse");
        $message = $this->capitaleService->testPays($pays, $reponse);
        return $this->render('capitale/reponse.html.twig', ["message" => $message]);
    }


}
