<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Media\Resource\Doctrine\Form\Element;

use MSBios\Media\Resource\Doctrine\Entity\News;
use Zend\Form\Element\Select;

/**
 * Class NewsType
 * @package MSBios\Media\Resource\Doctrine\Form\Element
 */
class NewsType extends Select
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->setValueOptions([
            News::TYPE_IMAGE => _('Image'),
            News::TYPE_VIDEO => _('Video'),
            News::TYPE_NONE => _('None'),
        ]);
    }
}
