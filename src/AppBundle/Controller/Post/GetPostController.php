<?php

namespace AppBundle\Controller\Post;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class GetPostController extends Controller
{
    /**
     * @Route("/post/{id}", methods={"GET"}, name="post")
     */
    public function getPostAction()
    {
        return $this->render("AppBundle:post:post.html.twig", array());
    }
}
