<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Media\Resource\Doctrine\Repository;

use MSBios\Resource\Doctrine\EntityRepository;

/**
 * Class NewsRepository
 * @package MSBios\Media\Resource\Doctrine\Repository
 */
class NewsRepository extends EntityRepository
{
    /** @const DEFAULT_ALIAS */
    const DEFAULT_ALIAS = 'n';
}