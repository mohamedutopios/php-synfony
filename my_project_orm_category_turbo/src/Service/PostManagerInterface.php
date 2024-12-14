<?php

namespace App\Service;

use App\DTO\PostDTO;
use App\Entity\Post;

interface PostManagerInterface
{


    /**
     * Récupère tous les posts.
     *
     * @return Post[]
     */
    public function getPosts(): array;

    /**
     * Récupère un post par son ID.
     *
     * @param int $id
     * @return Post|null
     */
    public function getPostById(int $id): ?Post;

    /**
     * Ajoute un nouveau post.
     *
     * @param string $title
     * @param string $content
     */
    public function addPost(PostDTO $postDTO): void;

    /**
     * Supprime un post par son ID.
     *
     * @param int $id
     */
    public function deletePost(int $id): void;
}