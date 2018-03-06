<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Media\Resource\Doctrine\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use MSBios\Resource\Doctrine\Repository\PaginatorRepositoryTrait;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Paginator\Paginator;

/**
 * Class NewsRepository
 * @package MSBios\Media\Resource\Doctrine\Repository
 */
class NewsRepository extends EntityRepository
{
    use PaginatorRepositoryTrait;

    /**
     * @param callable $closure
     * @param int $page
     * @param int $limit
     * @return Paginator
     */
    public function getPaginatorWith(callable $closure, $page = 1, $limit = 20)
    {
        /** @var QueryBuilder $qb */
        $qb = $this->createQueryBuilder('n');

        /** Execute colosure */
        $closure($qb);

        /** @var Paginator $paginator */
        $paginator = $this->buildPaginator($qb);
        $paginator->setDefaultItemCountPerPage($limit);
        $paginator->setCurrentPageNumber($page);
        return $paginator;
    }
}
