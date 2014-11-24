<?php

namespace Snippet;

use Snippet\V1\Rest\Category\CategoryService;
use Snippet\V1\Rest\Tag\TagService;
use Snippet\V1\Rest\User\UserService;
use SnippetDomain\SnippetService;
use ZF\Apigility\Provider\ApigilityProviderInterface;
use Snippet\V1\Rest\Like\LikeService;

class Module implements ApigilityProviderInterface
{

    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'ZF\Apigility\Autoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'categoryService' => function ($sm) {
                    $em = $sm->get('doctrine.entitymanager.orm_default');
                    $unitOfWork = $em->getUnitOfWork();
                    $categoryRepository = $em->getRepository('SnippetDomain\Entity\Category');
                    return new CategoryService($unitOfWork, $categoryRepository);
                },
                'tagService' => function ($sm) {
                    $em = $sm->get('doctrine.entitymanager.orm_default');
                    $unitOfWork = $em->getUnitOfWork();
                    $tagRepository = $em->getRepository('SnippetDomain\Entity\Tag');
                    return new TagService($unitOfWork, $tagRepository);
                },
                'likeService' => function ($sm) {
                    $em = $sm->get('doctrine.entitymanager.orm_default');
                    $unitOfWork = $em->getUnitOfWork();
                    $likeRepository = $em->getRepository('SnippetDomain\Entity\Social');
                    return new LikeService($unitOfWork, $likeRepository);
                },
                'snippetService' => function ($sm) {
                    $em = $sm->get('doctrine.entitymanager.orm_default');     
                    $unitOfWork = $em->getUnitOfWork();
                    $snippetRepository = $em->getRepository('SnippetDomain\Entity\Snippet');
                    return new SnippetService($unitOfWork, $snippetRepository);
                },
                'userService' => function ($sm) {
                    $em = $sm->get('doctrine.entitymanager.orm_default');   
                    $unitOfWork = $em->getUnitOfWork();
                    $userRepository = $em->getRepository('SnippetDomain\Entity\User');
                    return new UserService($unitOfWork, $userRepository);
                },
            ),
        );
    }
}
