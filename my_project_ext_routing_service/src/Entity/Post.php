<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\ORM\Mapping as ORM;
// src/Entity/Article.php
namespace App\Entity;

class Post
{
    public $id;
    public $title;
    public $content;
    public $createdAt;

    public function __construct($id, $title, $content, $createdAt)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->createdAt = $createdAt;
    }
}

