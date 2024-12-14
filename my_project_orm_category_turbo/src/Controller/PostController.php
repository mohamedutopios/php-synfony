<?php
namespace App\Controller;

use App\DTO\PostDTO;
use App\Service\PostManagerInterface;
use App\Service\CategoryManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    private PostManagerInterface $postManager;
    private CategoryManagerInterface $categoryManager;

    public function __construct(PostManagerInterface $postManager, CategoryManagerInterface $categoryManager)
    {
        $this->postManager = $postManager;
        $this->categoryManager = $categoryManager;
    }

    #[Route('/posts', name: 'post_index', methods: ['GET'])]
    public function index(): Response
    {
        $posts = $this->postManager->getPosts();

        return $this->render('post/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    #[Route('/post/create', name: 'post_create', methods: ['GET', 'POST'])]
    public function create(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $title = $request->request->get('title');
            $content = $request->request->get('content');
            $categoryId = $request->request->get('category_id');

            if (empty($title) || empty($content) || empty($categoryId)) {
                return $this->render('post/_form.html.twig', [
                    'error' => 'Title, content, and category are required.',
                    'categories' => $this->categoryManager->getAllCategories(),
                    'post' => null,
                    'action' => $this->generateUrl('post_create'),
                    'button_label' => 'Create',
                ]);
            }

            try {
                $postDTO = new PostDTO($title, $content, (int)$categoryId);
                $this->postManager->addPost($postDTO);

                // Retourner la liste mise à jour dans le Turbo Frame
                return $this->render('post/_list.html.twig', [
                    'posts' => $this->postManager->getPosts(),
                ]);
            } catch (\InvalidArgumentException $e) {
                return $this->render('post/_form.html.twig', [
                    'error' => $e->getMessage(),
                    'categories' => $this->categoryManager->getAllCategories(),
                    'post' => null,
                    'action' => $this->generateUrl('post_create'),
                    'button_label' => 'Create',
                ]);
            }
        }

        return $this->render('post/_form.html.twig', [
            'categories' => $this->categoryManager->getAllCategories(),
            'post' => null,
            'action' => $this->generateUrl('post_create'),
            'button_label' => 'Create',
        ]);
    }

    #[Route('/post/{id}', name: 'post_show', methods: ['GET'])]
    public function show(int $id): Response
    {
        $post = $this->postManager->getPostById($id);

        if (!$post) {
            throw $this->createNotFoundException(sprintf('The post with ID %d was not found.', $id));
        }

        return $this->render('post/_details.html.twig', [
            'post' => $post,
        ]);
    }

    #[Route('/post/{id}/edit', name: 'post_edit', methods: ['GET', 'POST'])]
    public function edit(int $id, Request $request): Response
    {
        $post = $this->postManager->getPostById($id);

        if (!$post) {
            throw $this->createNotFoundException(sprintf('Post with ID %d not found.', $id));
        }

        if ($request->isMethod('POST')) {
            $title = $request->request->get('title');
            $content = $request->request->get('content');
            $categoryId = $request->request->get('category_id');

            if (empty($title) || empty($content) || empty($categoryId)) {
                return $this->render('post/_form.html.twig', [
                    'error' => 'Title, content, and category are required.',
                    'categories' => $this->categoryManager->getAllCategories(),
                    'post' => $post,
                    'action' => $this->generateUrl('post_edit', ['id' => $id]),
                    'button_label' => 'Update',
                ]);
            }

            try {
                $postDTO = new PostDTO($title, $content, (int)$categoryId);
                $this->postManager->updatePost($post, $postDTO);

                // Retourner la liste mise à jour dans le Turbo Frame
                return $this->render('post/_list.html.twig', [
                    'posts' => $this->postManager->getPosts(),
                ]);
            } catch (\InvalidArgumentException $e) {
                return $this->render('post/_form.html.twig', [
                    'error' => $e->getMessage(),
                    'categories' => $this->categoryManager->getAllCategories(),
                    'post' => $post,
                    'action' => $this->generateUrl('post_edit', ['id' => $id]),
                    'button_label' => 'Update',
                ]);
            }
        }

        return $this->render('post/_form.html.twig', [
            'categories' => $this->categoryManager->getAllCategories(),
            'post' => $post,
            'action' => $this->generateUrl('post_edit', ['id' => $id]),
            'button_label' => 'Update',
        ]);
    }

    #[Route('/post/{id}/delete', name: 'post_delete', methods: ['POST'])]
    public function delete(int $id): Response
    {
        $post = $this->postManager->getPostById($id);

        if (!$post) {
            return $this->render('post/_list.html.twig', [
                'error' => sprintf('The post with ID %d was not found.', $id),
                'posts' => $this->postManager->getPosts(),
            ]);
        }

        $this->postManager->deletePost($id);

        return $this->render('post/_list.html.twig', [
            'posts' => $this->postManager->getPosts(),
        ]);
    }
}