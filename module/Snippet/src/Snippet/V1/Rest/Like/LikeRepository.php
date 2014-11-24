<?php
namespace Snippet\V1\Rest\Like;

use Doctrine\ORM\EntityRepository;

class LikeRepository extends EntityRepository
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
