<?php

namespace Snippet\V1\Rest\User;
use Doctrine\ORM\UnitOfWork;
use Snippet\V1\Rest\User\UserRepository;
use SnippetDomain\Entity\User;

class UserService
{

    /**
     * @var \Doctrine\ORM\UnitOfWork
     */
    protected $unitOfWork;

    /**
     * @var UserRepository
     */
    protected $categoryRepository;
    
    /**
     * @param UnitOfWork $unitOfWork
     * @param UserRepository $userRepository
     */
    public function __construct(UnitOfWork $unitOfWork, UserRepository $userRepository)
    {
        $this->unitOfWork = $unitOfWork;
        $this->userRepository = $userRepository;        
    }

    /**
     * @param User $user
     * @param string $password
     */
    public function save(User $user)
    {        
        $this->unitOfWork->persist($user);
        $this->unitOfWork->commit($user);
    }
    
    /**
     * @param type $id
     * @return User
     */
    public function findById($id)
    {
        return $this->userRepository->find($id);
    }
}
