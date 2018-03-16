<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Media\Resource\Doctrine\Form;

use MSBios\Doctrine\Form\Element\PublishingState;
use Zend\Form\Element\Collection;
use Zend\Form\Element\DateTime;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Text;
use Zend\Form\Element\Textarea;
use Zend\Form\ElementInterface;
use Zend\Form\Fieldset;
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

        /** @var ElementInterface $options */
        $options = new Fieldset('options');

        /** @var ElementInterface $thumb */
        $thumb = (new Fieldset('thumb'))->add([
            'type' => Hidden::class,
            'name' => 'width'
        ])->add([
            'type' => Hidden::class,
            'name' => 'height'
        ])->add([
            'type' => Hidden::class,
            'name' => 'src'
        ]);

        /** @var ElementInterface $image */
        $image = (new Fieldset)
            ->add([
                'type' => Hidden::class,
                'name' => 'name'
            ])->add([
                'type' => Hidden::class,
                'name' => 'type'
            ])->add([
                'type' => Hidden::class,
                'name' => 'width'
            ])->add([
                'type' => Hidden::class,
                'name' => 'height'
            ])->add([
                'type' => Hidden::class,
                'name' => 'src'
            ])->add([
                'type' => Hidden::class,
                'name' => 'size'
            ])->add([
                'type' => Hidden::class,
                'name' => 'error'
            ])->add($thumb);

        /** @var ElementInterface $image */
        $video = (new Fieldset('video'))
            ->add([
                'type' => Text::class,
                'name' => 'src'
            ]);

        $options->add($video);

        /** @var ElementInterface $images */
        $images = (new Collection('images'))
            ->setAllowAdd(true)
            ->setAllowRemove(true)
            ->setCount(0)
            ->setTargetElement($image);

        $options->add($images);

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
        ])->add($options);
    }
}
