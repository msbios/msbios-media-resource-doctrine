<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Media\Resource\Doctrine\Repository;

use Doctrine\ORM\EntityRepository;
use MSBios\Resource\Doctrine\Repository\PaginatorRepositoryTrait;
use Zend\Paginator\Paginator;

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
     * @return Paginator
     */
    public function getPaginator($page = 1, $limit = 20)
    {
        /** @var Paginator $paginator */
        $paginator = $this->buildPaginator($this->createQueryBuilder('n'));
        $paginator->setDefaultItemCountPerPage($limit);
        $paginator->setCurrentPageNumber($page);
        return $paginator;
    }
}