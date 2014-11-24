<?php
namespace Snippet\V1\Rest\Like;

use Doctrine\ORM\UnitOfWork;
use Snippet\V1\Rest\Like\LikeRepository;
use SnippetDomain\Entity\Social;

class LikeService
{

    /**
     * @var UnitOfWork
     */
    protected $unitOfWork;

    /**
     * @var LikeRepository
     */
    protected $likeRepository;

    /**
     * @param UnitOfWork $unitOfWork
     * @param LikeRepository $likeRepository
     */
    public function __construct(UnitOfWork $unitOfWork, LikeRepository $likeRepository)
    {
        $this->unitOfWork = $unitOfWork;
        $this->likeRepository = $likeRepository;
    }

    /**
     * @return Social $social
     */
    public function like(Social $social)
    {
        $this->unitOfWork->persist($social);
        $this->unitOfWork->commit($social);
    }
    
    /**
     * @return Social $social
     */
    public function unlike(Social $social)
    {
        $this->unitOfWork->remove($social);
        $this->unitOfWork->commit($social);
        return true;
    }
    
    /**
     * @param int $nodeId
     * @param string $userId
     * @return object|null
     */
    public function findLikeByNodeAndUser($nodeId, $userId)
    {
        $criteria = array('nodeId' => $nodeId, 'userId' => $userId, 'type' => Social::FAVORITE);
        return $this->likeRepository->findOneBy($criteria);
    }
    
    public function getLikedForUser($param)
    {
        return $this->likeRepository->findTagsList();
    }
    
    public function getLikedForNode($param)
    {
        return $this->likeRepository->findTagsList();
    }
}
