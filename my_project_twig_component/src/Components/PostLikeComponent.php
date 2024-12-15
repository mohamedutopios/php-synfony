<?php

namespace App\Components;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;


#[AsLiveComponent('post_like')]
class PostLikeComponent
{
    use DefaultActionTrait;

    #[LiveProp]
    public Post $post;

    #[LiveProp]
    public int $likes;

    public function __construct(private PostRepository $postRepository)
    {
    }

    #[LiveAction]
    public function like(): void
    {
        // Augmente les likes du post
        $this->post->setLikes($this->post->getLikes() + 1);
        $this->postRepository->save($this->post, true);

        // Mets à jour la propriété "likes"
        $this->likes = $this->post->getLikes();
    }
}
