<?php

namespace SnippetDomain;

use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;
use DoctrineModule\Stdlib\Hydrator\Strategy\AbstractCollectionStrategy;
use ZF\Hal\Collection;

/**
 * A field-specific hydrator for collecitons
 *
 * @returns HalCollection
 */
class CollectionExtract extends AbstractCollectionStrategy implements StrategyInterface
{

    public function extract($collection)
    {
        $coll = array();
        foreach ($collection as $key => $value) {
            $hydrator = new \Zend\Stdlib\Hydrator\ClassMethods();
            $coll[$key] = $hydrator->extract($value);
        }
        //$halCollection = new Collection($value);
        return $coll;
    }

    public function hydrate($value)
    {
// Hydration is not supported for collections.
// A call to PATCH will use hydration to extract then hydrate
// an entity. In this process a collection will be included
// so no error is thrown here.
    }

}
