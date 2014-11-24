<?php
return array(
    'router' => array(
        'routes' => array(
            'snippet.rest.snippet' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/snippets[/:id]',
                    'defaults' => array(
                        'controller' => 'Snippet\\V1\\Rest\\Snippet\\Controller',
                    ),
                ),
            ),
            'snippet.rest.user' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/users[/:user_id]',
                    'defaults' => array(
                        'controller' => 'Snippet\\V1\\Rest\\User\\Controller',
                    ),
                ),
            ),
            'snippet.rest.category' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/categories[/:category_id]',
                    'defaults' => array(
                        'controller' => 'Snippet\\V1\\Rest\\Category\\Controller',
                    ),
                ),
            ),
            'snippet.rest.tag' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/tags[/:tag_id]',
                    'defaults' => array(
                        'controller' => 'Snippet\\V1\\Rest\\Tag\\Controller',
                    ),
                ),
            ),
            'snippet.rest.like' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/likes[/:like_id]',
                    'defaults' => array(
                        'controller' => 'Snippet\\V1\\Rest\\Like\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'snippet.rest.snippet',
            1 => 'snippet.rest.user',
            2 => 'snippet.rest.category',
            3 => 'snippet.rest.tag',
            4 => 'snippet.rest.like',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Snippet\\V1\\Rest\\Snippet\\SnippetResource' => 'Snippet\\V1\\Rest\\Snippet\\SnippetResourceFactory',
            'Snippet\\V1\\Rest\\User\\UserResource' => 'Snippet\\V1\\Rest\\User\\UserResourceFactory',
            'Snippet\\V1\\Rest\\Category\\CategoryResource' => 'Snippet\\V1\\Rest\\Category\\CategoryResourceFactory',
            'Snippet\\V1\\Rest\\Tag\\TagResource' => 'Snippet\\V1\\Rest\\Tag\\TagResourceFactory',
            'Snippet\\V1\\Rest\\Like\\LikeResource' => 'Snippet\\V1\\Rest\\Like\\LikeResourceFactory',
        ),
    ),
    'zf-rest' => array(
        'Snippet\\V1\\Rest\\Snippet\\Controller' => array(
            'listener' => 'Snippet\\V1\\Rest\\Snippet\\SnippetResource',
            'route_name' => 'snippet.rest.snippet',
            'route_identifier_name' => 'id',
            'collection_name' => 'snippets',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PUT',
                2 => 'DELETE',
                3 => 'POST',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(
                0 => 'sort',
                1 => 'category',
                2 => 'tag',
                3 => 'user',
                4 => 'favorites',
            ),
            'page_size' => '15',
            'page_size_param' => '2',
            'entity_class' => 'SnippetDomain\\Entity\\Snippet',
            'collection_class' => 'Snippet\\V1\\Rest\\Snippet\\SnippetCollection',
            'service_name' => 'snippet',
        ),
        'Snippet\\V1\\Rest\\User\\Controller' => array(
            'listener' => 'Snippet\\V1\\Rest\\User\\UserResource',
            'route_name' => 'snippet.rest.user',
            'route_identifier_name' => 'user_id',
            'collection_name' => 'user',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'SnippetDomain\\Entity\\User',
            'collection_class' => 'Snippet\\V1\\Rest\\User\\UserCollection',
            'service_name' => 'user',
        ),
        'Snippet\\V1\\Rest\\Category\\Controller' => array(
            'listener' => 'Snippet\\V1\\Rest\\Category\\CategoryResource',
            'route_name' => 'snippet.rest.category',
            'route_identifier_name' => 'category_id',
            'collection_name' => 'category',
            'entity_http_methods' => array(
                0 => 'GET',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => '20',
            'entity_class' => 'SnippetDomain\\Entity\\Category',
            'collection_class' => 'Snippet\\V1\\Rest\\Category\\CategoryCollection',
            'service_name' => 'category',
        ),
        'Snippet\\V1\\Rest\\Tag\\Controller' => array(
            'listener' => 'Snippet\\V1\\Rest\\Tag\\TagResource',
            'route_name' => 'snippet.rest.tag',
            'route_identifier_name' => 'tag_id',
            'collection_name' => 'tag',
            'entity_http_methods' => array(),
            'collection_http_methods' => array(
                0 => 'GET',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => '20',
            'entity_class' => 'SnippetDomain\\Entity\\Tag',
            'collection_class' => 'Snippet\\V1\\Rest\\Tag\\TagCollection',
            'service_name' => 'tag',
        ),
        'Snippet\\V1\\Rest\\Like\\Controller' => array(
            'listener' => 'Snippet\\V1\\Rest\\Like\\LikeResource',
            'route_name' => 'snippet.rest.like',
            'route_identifier_name' => 'like_id',
            'collection_name' => 'like',
            'entity_http_methods' => array(
                0 => 'DELETE',
                1 => 'POST',
            ),
            'collection_http_methods' => array(
                0 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'SnippetDomain\\Entity\\Social',
            'collection_class' => 'Snippet\\V1\\Rest\\Like\\LikeCollection',
            'service_name' => 'like',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'Snippet\\V1\\Rest\\Snippet\\Controller' => 'HalJson',
            'Snippet\\V1\\Rest\\User\\Controller' => 'HalJson',
            'Snippet\\V1\\Rest\\Category\\Controller' => 'Json',
            'Snippet\\V1\\Rest\\Tag\\Controller' => 'Json',
            'Snippet\\V1\\Rest\\Like\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'Snippet\\V1\\Rest\\Snippet\\Controller' => array(
                0 => 'application/vnd.snippet.v1+json',
                1 => 'application/json',
                2 => 'application/hal+json',
            ),
            'Snippet\\V1\\Rest\\User\\Controller' => array(
                0 => 'application/vnd.snippet.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Snippet\\V1\\Rest\\Category\\Controller' => array(
                0 => 'application/vnd.snippet.v1+json',
                1 => 'application/json',
            ),
            'Snippet\\V1\\Rest\\Tag\\Controller' => array(
                0 => 'application/vnd.snippet.v1+json',
                1 => 'application/json',
            ),
            'Snippet\\V1\\Rest\\Like\\Controller' => array(
                0 => 'application/vnd.snippet.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'Snippet\\V1\\Rest\\Snippet\\Controller' => array(
                0 => 'application/vnd.snippet.v1+json',
                1 => 'application/json',
            ),
            'Snippet\\V1\\Rest\\User\\Controller' => array(
                0 => 'application/vnd.snippet.v1+json',
                1 => 'application/json',
            ),
            'Snippet\\V1\\Rest\\Category\\Controller' => array(
                0 => 'application/vnd.snippet.v1+json',
                1 => 'application/json',
            ),
            'Snippet\\V1\\Rest\\Tag\\Controller' => array(
                0 => 'application/vnd.snippet.v1+json',
                1 => 'application/json',
            ),
            'Snippet\\V1\\Rest\\Like\\Controller' => array(
                0 => 'application/vnd.snippet.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'Snippet\\V1\\Rest\\Snippet\\SnippetCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'snippet.rest.snippet',
                'route_identifier_name' => 'id',
                'is_collection' => true,
            ),
            'SnippetDomain\\Entity\\Snippet' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'snippet.rest.snippet',
                'route_identifier_name' => 'id',
                'hydrator' => 'hydratorSnippet',
            ),
            'Snippet\\V1\\Rest\\User\\UserEntity' => array(
                'entity_identifier_name' => 'userId',
                'route_name' => 'snippet.rest.user',
                'route_identifier_name' => 'user_id',
                'hydrator' => 'DoctrineModule\\Stdlib\\Hydrator\\DoctrineObject',
            ),
            'Snippet\\V1\\Rest\\User\\UserCollection' => array(
                'entity_identifier_name' => 'userId',
                'route_name' => 'snippet.rest.user',
                'route_identifier_name' => 'user_id',
                'is_collection' => true,
            ),
            'Snippet\\V1\\Rest\\Category\\CategoryCollection' => array(
                'entity_identifier_name' => 'categoryId',
                'route_name' => 'snippet.rest.category',
                'route_identifier_name' => 'category_id',
                'is_collection' => true,
            ),
            'SnippetDomain\\Entity\\Category' => array(
                'entity_identifier_name' => 'categoryId',
                'route_name' => 'snippet.rest.category',
                'route_identifier_name' => 'category_id',
                'hydrator' => 'DoctrineModule\\Stdlib\\Hydrator\\DoctrineObject',
            ),
            'SnippetDomain\\Entity\\Tag' => array(
                'entity_identifier_name' => 'tagId',
                'route_name' => 'snippet.rest.tag',
                'route_identifier_name' => 'tag_id',
                'hydrator' => 'DoctrineModule\\Stdlib\\Hydrator\\DoctrineObject',
            ),
            'Snippet\\V1\\Rest\\Tag\\TagCollection' => array(
                'entity_identifier_name' => 'tagId',
                'route_name' => 'snippet.rest.tag',
                'route_identifier_name' => 'tag_id',
                'is_collection' => true,
            ),
            'SnippetDomain\\Entity\\User' => array(
                'entity_identifier_name' => 'userId',
                'route_name' => 'snippet.rest.user',
                'route_identifier_name' => 'user_id',
                'hydrator' => 'DoctrineModule\\Stdlib\\Hydrator\\DoctrineObject',
            ),
            'SnippetDomain\\Entity\\Social' => array(
                'entity_identifier_name' => 'socialId',
                'route_name' => 'snippet.rest.like',
                'route_identifier_name' => 'like_id',
                'hydrator' => 'DoctrineModule\\Stdlib\\Hydrator\\DoctrineObject',
            ),
            'Snippet\\V1\\Rest\\Like\\LikeCollection' => array(
                'entity_identifier_name' => 'socialId',
                'route_name' => 'snippet.rest.like',
                'route_identifier_name' => 'like_id',
                'is_collection' => true,
            ),
        ),
    ),
    'zf-content-validation' => array(
        'Snippet\\V1\\Rest\\Snippet\\Controller' => array(
            'input_filter' => 'Snippet\\V1\\Rest\\Snippet\\Validator',
        ),
        'Snippet\\V1\\Rest\\Category\\Controller' => array(
            'input_filter' => 'Snippet\\V1\\Rest\\Category\\Validator',
        ),
    ),
    'input_filter_specs' => array(
        'Snippet\\V1\\Rest\\Snippet\\Validator' => array(
            0 => array(
                'name' => 'title',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            1 => array(
                'name' => 'description',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            2 => array(
                'name' => 'code',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
            3 => array(
                'name' => 'tags',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => true,
                'continue_if_empty' => true,
            ),
            4 => array(
                'name' => 'categories',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
                'allow_empty' => false,
                'continue_if_empty' => false,
            ),
        ),
        'Snippet\\V1\\Rest\\Category\\Validator' => array(
            0 => array(
                'name' => 'categoryId',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            1 => array(
                'name' => 'category',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
        ),
    ),
    'zf-mvc-auth' => array(
        'authorization' => array(
            'Snippet\\V1\\Rest\\Snippet\\Controller' => array(
                'entity' => array(
                    'GET' => false,
                    'POST' => false,
                    'PATCH' => false,
                    'PUT' => false,
                    'DELETE' => true,
                ),
                'collection' => array(
                    'GET' => false,
                    'POST' => false,
                    'PATCH' => false,
                    'PUT' => false,
                    'DELETE' => true,
                ),
            ),
            'Snippet\\V1\\Rest\\User\\Controller' => array(
                'entity' => array(
                    'GET' => false,
                    'POST' => false,
                    'PATCH' => false,
                    'PUT' => false,
                    'DELETE' => true,
                ),
                'collection' => array(
                    'GET' => false,
                    'POST' => false,
                    'PATCH' => false,
                    'PUT' => false,
                    'DELETE' => true,
                ),
            ),
        ),
    ),
);
