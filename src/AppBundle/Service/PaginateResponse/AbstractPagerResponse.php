<?php

namespace AppBundle\Service\PaginateResponse;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\QueryBuilder;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Exception;

/**
 * Class AbstractPagerResponse.
 *
 * @author Valentyn Hrynevych <valik.grinevich@mev.com>
 */
abstract class AbstractPagerResponse
{
    /**
     * @var Pagerfanta
     */
    protected $pagerfanta;

    /**
     * @param QueryBuilder $queryBuilder
     */
    public function setQueryBuilder(QueryBuilder $queryBuilder)
    {
        $adapter = new DoctrineORMAdapter($queryBuilder);
        $this->pagerfanta = new Pagerfanta($adapter);
    }

    /**
     * @param int $limit
     *
     * @throws Exception
     */
    public function setMaxPerPage(int $limit)
    {
        if (null === $this->pagerfanta) {
            throw new Exception();
        }

        $this->pagerfanta->setMaxPerPage($limit);
    }

    public function setCurrentPage(int $page)
    {
        if (null === $this->pagerfanta) {
            throw new Exception();
        }

        $this->pagerfanta->setCurrentPage($page);
    }

    /**
     * @return array
     */
    protected function getMeta()
    {
        return [
            'limit' => $this->pagerfanta->getMaxPerPage(),
            'maxPage' => $this->pagerfanta->getNbPages(),
            'nextPage' => $this->getNextPage(),
            'prevPage' => $this->getPreviousPage(),
        ];
    }

    /**
     * @return ArrayCollection
     */
    protected function getData()
    {
        $collection = new ArrayCollection();

        foreach ($this->pagerfanta->getIterator() as $item) {
            $collection->add($item);
        }

        return $collection;
    }

    /**
     * @return int|null
     */
    protected function getNextPage()
    {
        return ($this->pagerfanta->getCurrentPage() !== $this->pagerfanta->getNbPages())
            ? $this->pagerfanta->getNextPage()
            : null;
    }

    /**
     * @return int|null
     */
    protected function getPreviousPage()
    {
        return ($this->pagerfanta->getCurrentPage() !== 1)
            ? $this->pagerfanta->getPreviousPage()
            : null;
    }

    /**
     * @param QueryBuilder $builder
     * @param int $page
     * @param int $limit
     * @param array $parameters
     *
     * @return array
     */
    abstract public function getResponse(QueryBuilder $builder, int $page, int $limit, array $parameters = []): array;
}
