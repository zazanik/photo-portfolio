<?php

namespace AppBundle\Service\Post;

use AppBundle\Repository\PostRepository;
use AppBundle\Service\PaginateResponse\PostsResponse;

/**
 * Class GetPostsService
 *
 */
class GetPostsService
{
    /**
     * GetPostsService constructor.
     *
     * @param PostRepository $postRepository
     * @param PostsResponse $postsResponse
     */
    public function __construct(
        PostRepository $postRepository,
        PostsResponse $postsResponse
    ) {
        $this->postRepository = $postRepository;
        $this->postsResponse = $postsResponse;
    }

    public function getPosts(int $page, int $limit): array
    {
        $queryBuilder = $this->postRepository->getPosts();

        return $this->postsResponse->getResponse($queryBuilder, $page, $limit);
    }
}
