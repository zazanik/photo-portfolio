<?php

namespace AppBundle\Controller\Post;

use AppBundle\Entity\Post;
use AppBundle\Service\Post\GetPostsService;
use AppBundle\Service\PaginateResponse\PostsResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GetPostsController extends Controller
{
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
     * @Route("/")
     */
    public function redirectToPortfolio()
    {
        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route(
     *     "/portfolio/{page}",
     *     defaults={"page" = 1},
     *     requirements={"id" = "\d+"},
     *     methods={"GET"},
     *     name="homepage"
     * )
     * @param Request $request
     * @return mixed
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
