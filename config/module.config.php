<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Media\Resource\Doctrine;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'doctrine' => [
        'configuration' => [
            'orm_default' => [
                'types' => [
                    DBAL\Types\NewsType::NAME =>
                        DBAL\Types\NewsType::class,
                ],
            ],
        ],
        'driver' => [
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
            Module::class => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../src/Entity'
                ],
            ],

            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default' => [
                'drivers' => [
                    Entity::class =>
                        Module::class,
                ]
            ],
        ],
        'entity_resolver' => [
            'orm_default' => [
                'resolvers' => [
                    // ...
                ],
            ],
        ],
    ],

    'form_elements' => [
        'factories' => [
            Form\NewsForm::class =>
                InvokableFactory::class,
            Form\Element\NewsType::class =>
                InvokableFactory::class
        ]
    ],
];
