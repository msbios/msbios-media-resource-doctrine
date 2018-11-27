<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Media\Resource\Doctrine\Form;

use MSBios\Doctrine\Form\Element\PublishingState;
use MSBios\Media\Resource\Doctrine\Form\Element\NewsType;
use Zend\Form\Element;
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
            'type' => Element\Hidden::class,
            'name' => 'width'
        ])->add([
            'type' => Element\Hidden::class,
            'name' => 'height'
        ])->add([
            'type' => Element\Hidden::class,
            'name' => 'src'
        ]);

        /** @var ElementInterface $image */
        $image = (new Fieldset)
            ->add([
                'type' => Element\Hidden::class,
                'name' => 'name'
            ])->add([
                'type' => Element\Hidden::class,
                'name' => 'type'
            ])->add([
                'type' => Element\Hidden::class,
                'name' => 'width'
            ])->add([
                'type' => Element\Hidden::class,
                'name' => 'height'
            ])->add([
                'type' => Element\Hidden::class,
                'name' => 'src'
            ])->add([
                'type' => Element\Hidden::class,
                'name' => 'size'
            ])->add([
                'type' => Element\Hidden::class,
                'name' => 'error'
            ])->add($thumb);

        /** @var ElementInterface $image */
        $video = (new Fieldset('video'))
            ->add([
                'type' => Element\Text::class,
                'name' => 'src'
            ]);

        $options->add($video);

        /** @var ElementInterface $images */
        $images = (new Element\Collection('images'))
            ->setAllowAdd(true)
            ->setAllowRemove(true)
            ->setCount(0)
            ->setTargetElement($image);

        $options->add($images);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'title'
        ])->add([
            'type' => Element\Text::class,
            'name' => 'slug'
        ])->add([
            'type' => NewsType::class,
            'name' => 'type'
        ])->add([
            'type' => Element\Textarea::class,
            'name' => 'content'
        ])->add([
            'type' => Element\DateTime::class,
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
