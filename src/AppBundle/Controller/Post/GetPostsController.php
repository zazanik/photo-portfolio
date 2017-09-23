<?php

namespace AppBundle\Controller\Post;

use AppBundle\Entity\Post;
use AppBundle\Service\Post\GetPostsService;
use AppBundle\Service\Response\PostsResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GetPostsController extends Controller
{
//    /**
//     * @Route("/", methods={"GET"}, name="homepage")
//     */
//    public function getPostsAction(Request $request)
//    {
//        $doctrine = $this->getDoctrine();
//        $entity = $doctrine->getRepository(Post::class);
//        $posts = $entity->findAll();
//
//        return $this->render("AppBundle:post:posts.html.twig", array(
//            'posts' => $posts
//        ));
//    }

    /**
     * @var GetPostsService
     */
    protected $getPostsService;

    /**
     *
     * @param GetPostsService $getPostsService
     */
    public function __construct(GetPostsService $getPostsService)
    {
        $this->getPostsService = $getPostsService;
    }

    /**
     * @Route("/{page}", defaults={"page" = 1}, methods={"GET"}, name="homepage")
     */
    public function getPostsAction(Request $request)
    {
        $page = (int) $request->get('page', PostsResponse::DEFAULT_PAGE);
        $limit = (int) $request->get('limit', PostsResponse::DEFAULT_COUNT_ROWS);

        $posts = $this->getPostsService->getPosts($page, $limit);

        dump($posts);

        return $this->render("AppBundle:post:posts.html.twig", array(
            'posts' => $posts
        ));
    }
}
