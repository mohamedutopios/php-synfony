<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;

class PostController extends AbstractController
{
    private function initializeData(Request $request): void
    {
        $session = $request->getSession();

        // Si les posts ne sont pas déjà initialisés dans la session
        if (!$session->has('posts')) {
            $posts = [
                1 => new Post(1, 'Post 1', 'This is the first post.', new \DateTime('-2 days')),
                2 => new Post(2, 'Post 2', 'This is the second post.', new \DateTime('-1 days')),
            ];
            $session->set('posts', $posts); // Initialiser la session avec les posts par défaut
        }
    }


    public function index(Request $request): Response
    {
        // Initialiser les données si nécessaire
        $this->initializeData($request);

        $session = $request->getSession();
        $posts = $session->get('posts');

        return $this->render('post/index.html.twig', [
            'posts' => $posts,
        ]);
    }


    public function show(Request $request, int $id): Response
    {
        $this->initializeData($request);

        $session = $request->getSession();
        $posts = $session->get('posts', []);

        $post = $posts[$id] ?? null;

        if (!$post) {
            throw $this->createNotFoundException(sprintf('The post with ID %d was not found.', $id));
        }

        return $this->render('post/show.html.twig', [
            'post' => $post,
        ]);
    }


    public function create(Request $request): Response
    {
        $this->initializeData($request);

        $session = $request->getSession();

        if ($request->isMethod('POST')) {
            $title = $request->request->get('title');
            $content = $request->request->get('content');

            $posts = $session->get('posts', []);

            $newId = count($posts) + 1;
            $newPost = new Post($newId, $title, $content, new \DateTime());

            $posts[$newId] = $newPost;
            $session->set('posts', $posts); // Mise à jour de la session

            return $this->redirectToRoute('post_index');
        }

        return $this->render('post/create.html.twig');
    }


    public function edit(Request $request, int $id): Response
    {
        $this->initializeData($request);

        $session = $request->getSession();
        $posts = $session->get('posts', []);

        $post = $posts[$id] ?? null;

        if (!$post) {
            throw $this->createNotFoundException('Post not found');
        }

        if ($request->isMethod('POST')) {
            $post->title = $request->request->get('title');
            $post->content = $request->request->get('content');

            $posts[$id] = $post; // Mise à jour du post
            $session->set('posts', $posts);

            return $this->redirectToRoute('post_index');
        }

        return $this->render('post/edit.html.twig', [
            'post' => $post,
        ]);
    }


    public function delete(Request $request, int $id): Response
    {
        $this->initializeData($request);

        $session = $request->getSession();
        $posts = $session->get('posts', []);

        if (isset($posts[$id])) {
            unset($posts[$id]);
            $session->set('posts', $posts); // Mise à jour de la session
        }

        return $this->redirectToRoute('post_index');
    }
}
