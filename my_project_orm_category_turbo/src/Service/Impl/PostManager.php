<?php
namespace App\Service\Impl;

use App\DTO\PostDTO;
use App\Entity\Post;
use App\Repository\PostRepository;
use App\Service\CategoryManagerInterface;
use App\Service\PostManagerInterface;
use Doctrine\ORM\EntityManagerInterface;

class PostManager implements PostManagerInterface
{
    private PostRepository $postRepository;
    private EntityManagerInterface $entityManager;
    private CategoryManagerInterface $categoryManager;

    public function __construct(
        PostRepository $postRepository,
        EntityManagerInterface $entityManager,
        CategoryManagerInterface $categoryManager
    ) {
        $this->postRepository = $postRepository;
        $this->entityManager = $entityManager;
        $this->categoryManager = $categoryManager;
    }

    public function getPosts(): array
    {
        return $this->postRepository->findAll();
    }

    public function getPostById(int $id): ?Post
    {
        return $this->postRepository->find($id);
    }

    public function addPost(PostDTO $postDTO): void
    {
        $category = $this->categoryManager->getCategoryById($postDTO->categoryId);

        if (!$category) {
            throw new \InvalidArgumentException('Category not found.');
        }

        $post = new Post();
        $post->setTitle($postDTO->title)
            ->setContent($postDTO->content)
            ->setCreatedAt(new \DateTime())
            ->setCategory($category);

        $this->entityManager->persist($post);
        $this->entityManager->flush();
    }

    public function updatePost(Post $post, PostDTO $postDTO): void
    {
        $category = $this->categoryManager->getCategoryById($postDTO->categoryId);

        if (!$category) {
            throw new \InvalidArgumentException('Category not found.');
        }

        $post->setTitle($postDTO->title)
            ->setContent($postDTO->content)
            ->setCategory($category);

        $this->entityManager->flush();
    }

    public function deletePost(int $id): void
    {
        $post = $this->postRepository->find($id);
        if ($post) {
            $this->entityManager->remove($post);
            $this->entityManager->flush();
        }
    }
}
