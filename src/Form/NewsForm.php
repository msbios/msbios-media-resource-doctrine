<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Media\Resource\Doctrine\Form;

use MSBios\Doctrine\Form\Element\PublishingState;
use Zend\Form\Element\DateTime;
use Zend\Form\Element\Text;
use Zend\Form\Element\Textarea;
use Zend\Form\Form;

/**
 * Class NewsForm
 * @package MSBios\Media\Resource\Doctrine\Form
 * @todo need realization in MSBios\Media\Resource in future
 */
class NewsForm extends Form
{
    /**
     * @override
     */
    public function init()
    {
        parent::init();

        $this->add([
            'type' => Text::class,
            'name' => 'title'
        ])->add([
            'type' => Text::class,
            'name' => 'slug'
        ])->add([
            'type' => Element\NewsType::class,
            'name' => 'type'
        ])->add([
            'type' => Textarea::class,
            'name' => 'content'
        ])->add([
            'type' => DateTime::class,
            'name' => 'postdate',
            'options' => [
                'format' => 'Y-m-d'
            ],
        ])->add([
            'type' => PublishingState::class,
            'name' => 'state'
        ]);
    }
}
