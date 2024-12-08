<?php

namespace App\Controller;

use App\Service\PostManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Service\Attribute\Required;


class PostController extends AbstractController
{
    #[Required]
    private ?PostManagerInterface $postManager = null; // Propriété nullable pour une meilleure gestion

    /**
     * Méthode d'accès sécurisée à la dépendance `PostManagerInterface`.
     */
    private function getPostManager(): PostManagerInterface
    {
        if ($this->postManager === null) {
            throw new \LogicException('The PostManager service has not been initialized.');
        }

        return $this->postManager;
    }

    #[Route('/', name: 'post_index')]
    public function index(): Response
    {
        $postManager = $this->getPostManager(); // Accès via la méthode sécurisée
        $postManager->initializeData();
        $posts = $postManager->getPosts();

        return $this->render('post/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    #[Route('/post/{id}', name: 'post_show')]
    public function show(int $id): Response
    {
        $postManager = $this->getPostManager();
        $postManager->initializeData();
        $post = $postManager->getPostById($id);

        if (!$post) {
            throw $this->createNotFoundException(sprintf('The post with ID %d was not found.', $id));
        }

        return $this->render('post/show.html.twig', [
            'post' => $post,
        ]);
    }

    #[Route('/post/create', name: 'post_create')]
    public function create(Request $request): Response
    {
        $postManager = $this->getPostManager();
        $postManager->initializeData();

        if ($request->isMethod('POST')) {
            $title = $request->request->get('title');
            $content = $request->request->get('content');

            $postManager->addPost($title, $content);

            return $this->redirectToRoute('post_index');
        }

        return $this->render('post/create.html.twig');
    }

    #[Route('/post/delete/{id}', name: 'post_delete')]
    public function delete(int $id): Response
    {
        $postManager = $this->getPostManager();
        $postManager->initializeData();
        $postManager->deletePost($id);

        return $this->redirectToRoute('post_index');
    }
}
