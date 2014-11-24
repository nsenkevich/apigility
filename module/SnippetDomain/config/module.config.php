<?php
namespace SnippetDomain;

return array(
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array( __DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
        ))),
    'hydrators' => array(
        'factories' => array(
            'hydratorSnippet' => 'SnippetDomain\SnippetHydratorFactory'
        )
    ),
    'zf-hal' => array(
        'renderer' => array(
            // 'default_hydrator' => 'Hydrator Service Name',
             'hydrators'        => array(
                'hydratorSnippet' => 'hydratorSnippet'
             ),
        ),
     ),
);
