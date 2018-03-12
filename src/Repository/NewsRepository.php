<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Media\Resource\Doctrine\Repository;

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use MSBios\Resource\Doctrine\Repository\PaginatorRepositoryTrait;
use Zend\InputFilter\Factory;
use Zend\InputFilter\InputFilter;
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
        $qb->orderBy('n.postdate', 'DESC');

        /** Execute colosure */
        $closure($qb);

        /** @var Paginator $paginator */
        $paginator = $this->buildPaginator($qb);
        $paginator->setDefaultItemCountPerPage($limit);
        $paginator->setCurrentPageNumber($page);
        return $paginator;
    }

    /**
     * @param array $params
     * @param int $page
     * @param int $limit
     * @return Paginator
     */
    public function getPaginatorFromQuery(array $params, $page = 1, $limit = 20)
    {
        /** @var InputFilterInterface $factory */
        $inputFilter = (new Factory)->createInputFilter([
            [
                'name' => 'title',
                'required' => false,
            ], [
                'type' => InputFilter::class,
                'name' => 'postdate',
                [
                    'name' => 'from',
                    'required' => false,
                ], [
                    'name' => 'to',
                    'required' => false,
                ]
            ]
        ])->setData($params);

        return $this->getPaginatorWith(function (QueryBuilder $qb) use ($inputFilter) {

            if ($inputFilter->isValid()) {

                /** @var array $values */
                $values = $inputFilter->getValues();

                if (! empty($values['title'])) {
                    $qb->where('n.title LIKE :title')
                        ->setParameter('title', "{$values['title']}%");
                }

                if (! empty($values['postdate']['from']) && ! empty($values['postdate']['to'])) {
                    $qb->andWhere('n.postdate BETWEEN :from AND :to')
                        ->setParameter('from', new \DateTime($values['postdate']['from']), Type::DATETIME)
                        ->setParameter('to', new \DateTime($values['postdate']['to']), Type::DATETIME);
                } elseif (! empty($values['postdate']['from'])) {
                    $qb->andWhere('n.postdate > :from')
                        ->setParameter('from', new \DateTime($values['postdate']['from']), Type::DATETIME);
                } elseif (! empty($values['postdate']['to'])) {
                    $qb->andWhere('n.postdate < :to')
                        ->setParameter('to', new \DateTime($values['postdate']['to']), Type::DATETIME);
                } else {
                    $qb->andWhere('n.postdate < :now')
                        ->setParameter('now', new \DateTime('now'), Type::DATETIME);
                }
            }
        }, $page, $limit);
    }
}
