<?php

namespace SnippetDomain\Repository;

use Snippet\Repository\SnippetReadInterface;
use Snippet\Repository\SnippetWriteInterface;
use Doctrine\ORM\EntityRepository;

class SnippetRepository extends EntityRepository //implements SnippetReadInterface, SnippetWriteInterface
{
    /**
     * @param Entities $entity
     */
    public function saveEntity($entity) {
        $this->_em->persist($entity);
        $this->_em->flush();
    }

    /**
     * @param Entities $entity
     */
    public function removeEntity($entity) {
        $this->_em->remove($entity);
        $this->_em->flush();
    }

    /**
     * persist entity
     * @param Entities $entity
     */
    public function persistEntity($entity) {
        $this->_em->persist($entity);
    }

    /**
     * Provides flush
     *
     * @return void
     */
    public function commit() {
        $this->_em->flush();
    }
}
