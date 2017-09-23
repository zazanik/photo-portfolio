<?php

namespace AppBundle\Controller\Post;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class GetPostsController extends Controller
{
    /**
     * @Route("/", methods={"GET"}, name="homepage")
     */
    public function getPostsAction()
    {
        return $this->render("post/posts.html.twig", array());
    }
}
