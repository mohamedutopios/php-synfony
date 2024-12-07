<?php

namespace App\Controller;

use App\Repository\PersonRepository;
use App\Entity\Person;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class PersonController extends AbstractController
{
    public function __construct(private PersonRepository $personRepository, private SerializerInterface $serializer)
    {
        
    }
    #[Route('/person', name: 'app_person', methods:["GET"])]
    public function index(): Response
    {
        return JsonResponse::fromJsonString($this->serializer->serialize($this->personRepository->findAll(), 'json'));
    }

    #[Route('/person', name: 'app_person_post', methods:["POST"])]
    public function post(Request $request): Response
    {
        $personEntity = $this->serializer->deserialize($request->getContent(), Person::class,'json');
        // $personEntity = new Person();
        // $personEntity->setFirstname($person->firstname);
        // $personEntity->setLastname($person->lastname);
        $this->personRepository->save($personEntity);
        return JsonResponse::fromJsonString($this->serializer->serialize($personEntity, 'json'));
    }

    

    
}
