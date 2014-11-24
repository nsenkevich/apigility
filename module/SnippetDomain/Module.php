<?php

namespace SnippetDomain;
use SnippetDomain\SnippetService;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class Module {

    public function getAutoloaderConfig()
    {
        
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig() {
//        return array(            
//          'factories' => array(
//            'snippetService' => function ($sm) {
//                $em = $sm->get('doctrine.entitymanager.orm_default');                
//                $snippetRepository = $em->getRepository('SnippetDomain\Entity\Snippet');
//                $OAuth2Server = $sm->get('ZF\OAuth2\Service\OAuth2Server');
//                $snippetService = new SnippetService($snippetRepository, $OAuth2Server);
//                return $snippetService;
//            },
//          ),
//        );
  }
}
