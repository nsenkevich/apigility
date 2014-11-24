<?php
namespace Snippet\V1\Rest\Tag;

use Doctrine\ORM\EntityRepository;

class TagRepository extends EntityRepository
{

    /**
     * @return array
     */
    public function findTagsList()
    {
        $tags = $this->createQueryBuilder('t')
        ->select('t.text')
        ->distinct()
        ->getQuery();

        return $tags->getResult();
    }
}
