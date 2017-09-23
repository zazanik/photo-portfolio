<?php

namespace AppBundle\Service\Response;

use AppBundle\Service\Paginate\AbstractPagerResponse;
use Doctrine\ORM\QueryBuilder;

class PostsResponse extends AbstractPagerResponse
{
    /**
     * @var int
     */
    const DEFAULT_PAGE = 1;

    /**
     * @var int
     */
    const DEFAULT_COUNT_ROWS = 10;

    /**
     * @param QueryBuilder $builder
     * @param int $page
     * @param int $limit
     * @param array $parameters
     *
     * @return array
     */
    public function getResponse(
        QueryBuilder $builder,
        int $page = self::DEFAULT_PAGE,
        int $limit = self::DEFAULT_COUNT_ROWS,
        array $parameters = []
    ): array {
        $this->setQueryBuilder($builder);
        $this->setMaxPerPage($limit);
        $this->setCurrentPage($page);

        $meta = array_merge($this->getMeta(), [
            'allowAddNew' => true,
        ]);

        return [
            'meta' => $meta,
            'posts' => $this->getData(),
        ];
    }
}
