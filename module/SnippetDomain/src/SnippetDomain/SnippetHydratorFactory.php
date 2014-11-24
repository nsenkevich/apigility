<?php
namespace SnippetDomain;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use SnippetDomain\CollectionExtract;
use SnippetDomain\CollectionLink;

class SnippetHydratorFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $parentLocator = $serviceLocator->getServiceLocator();
        
        $hydrator = new DoctrineObject($parentLocator->get('doctrine.entitymanager.orm_default'));
        $hydrator->addStrategy('tags', new CollectionExtract());
        $hydrator->addStrategy('categories', new CollectionExtract());
        //$hydrator->addStrategy('feedbacks', new CollectionExtract());
        return $hydrator; 
    }
}