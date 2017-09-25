<?php

namespace AppBundle\Controller\Admin\Post;

use AppBundle\Entity\Post;
use AppBundle\Service\Post\GetPostsService;
use AppBundle\Service\PaginateResponse\PostsResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GetAdminPostsController extends Controller
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
     * @Route(
     *     "/admin/posts/{page}",
     *     defaults={"page" = 1},
     *     methods={"GET"},
     *     name="admin_posts"
     * )
     */
    public function getPostsAction(Request $request)
    {
        $page = (int) $request->get('page', PostsResponse::DEFAULT_PAGE);
        $limit = (int) $request->get('limit', PostsResponse::DEFAULT_COUNT_ROWS);

        $posts = $this->getPostsService->getPosts($page, $limit);

        dump($posts);

        return $this->render("AppBundle:admin/post:posts.html.twig", array(
            'posts' => $posts
        ));
    }
}
