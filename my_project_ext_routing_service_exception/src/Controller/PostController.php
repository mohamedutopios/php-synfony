<?php

namespace App\Controller;

use App\Service\PostManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    private PostManagerInterface $postManager;

    public function __construct(PostManagerInterface $postManager)
    {
        $this->postManager = $postManager;
    }

    #[Route('/', name: 'post_index', methods: ['GET'])]
    public function index(): Response
    {
        $posts = $this->postManager->getPosts();

        if (!$posts) {
            $this->postManager->initializeData();
            $posts = $this->postManager->getPosts();
        }

        return $this->render('post/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    #[Route('/post/{id}', name: 'post_show', methods: ['GET'])]
    public function show(int $id): Response
    {
        $post = $this->postManager->getPostById($id);

        if (!$post) {
            // Lève une exception NotFoundHttpException
            throw $this->createNotFoundException(sprintf('The post with ID %d was not found.', $id));
        }

        return $this->render('post/show.html.twig', [
            'post' => $post,
        ]);
    }

    #[Route('/post/create', name: 'post_create', methods: ['GET', 'POST'])]
    public function create(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $title = $request->request->get('title');
            $content = $request->request->get('content');

            if (empty($title) || empty($content)) {
                // Lève une exception InvalidArgumentException
                throw new \InvalidArgumentException('Both title and content are required.');
            }

            $this->postManager->addPost($title, $content);

            $this->addFlash('success', 'Post created successfully!');
            return $this->redirectToRoute('post_index');
        }

        return $this->render('post/create.html.twig');
    }

    #[Route('/post/{id}/edit', name: 'post_edit', methods: ['GET', 'POST'])]
    public function edit(int $id, Request $request): Response
    {
        $post = $this->postManager->getPostById($id);

        if (!$post) {
            // Lève une exception NotFoundHttpException
            throw $this->createNotFoundException(sprintf('The post with ID %d was not found.', $id));
        }

        if ($request->isMethod('POST')) {
            $title = $request->request->get('title');
            $content = $request->request->get('content');

            if (empty($title) || empty($content)) {
                // Lève une exception InvalidArgumentException
                throw new \InvalidArgumentException('Both title and content are required.');
            }

            $post->setTitle($title);
            $post->setContent($content);

            $this->addFlash('success', 'Post updated successfully!');
            return $this->redirectToRoute('post_show', ['id' => $id]);
        }

        return $this->render('post/edit.html.twig', [
            'post' => $post,
        ]);
    }

    #[Route('/post/delete/{id}', name: 'post_delete', methods: ['POST'])]
    public function delete(int $id): Response
    {
        $post = $this->postManager->getPostById($id);

        if (!$post) {
            // Lève une exception NotFoundHttpException
            throw $this->createNotFoundException(sprintf('The post with ID %d was not found.', $id));
        }

        $this->postManager->deletePost($id);

        $this->addFlash('success', sprintf('Post with ID %d was deleted successfully.', $id));
        return $this->redirectToRoute('post_index');
    }
}
