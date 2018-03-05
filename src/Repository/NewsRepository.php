<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Media\Resource\Doctrine\Repository;

use Doctrine\ORM\EntityRepository;
use MSBios\Resource\Doctrine\Repository\PaginatorRepositoryTrait;

/**
 * Class NewsRepository
 * @package MSBios\Media\Resource\Doctrine\Repository
 */
class NewsRepository extends EntityRepository
{
    use PaginatorRepositoryTrait;

    /**
     * @param int $page
     * @param int $limit
     * @return mixed
     */
    public function getPaginator($page = 1, $limit = 20)
    {
        return $this->buildPaginator($this->createQueryBuilder('n'))
            ->setDefaultItemCountPerPage($limit)
            ->setCurrentPageNumber($page);
    }
}