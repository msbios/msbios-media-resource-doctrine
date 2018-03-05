<?php
/**
 * @access protected
 * @author Judzhin Miles <judzhin[at]gns-it.com>
 */

namespace MSBios\Media\Resource\Doctrine\DBAL\Types;

use MSBios\Doctrine\DBAL\Types\EnumType;
use MSBios\Media\Resource\Doctrine\Entity\News;

/**
 * Class NewsType
 * @package MSBios\Media\Resource\Doctrine\DBAL\Types
 */
class NewsType extends EnumType
{
    /** @const NAME */
    const NAME = 'news_type';

    /**
     * @return array
     */
    public function getValues()
    {
        return [
            News::TYPE_IMAGE,
            News::TYPE_VIDEO,
            News::TYPE_NONE,
        ];
    }

    /**
     * Gets the name of this type.
     *
     * @return string
     *
     * @todo Needed?
     */
    public function getName()
    {
        return self::NAME;
    }
}
