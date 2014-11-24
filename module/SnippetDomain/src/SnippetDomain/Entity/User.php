<?php

namespace SnippetDomain\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Snippet\V1\Rest\User\UserRepository")
 * @ORM\Table(name = "users")
 */
class User
{
    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(type="string");
     */
    private $userId;
    
    /**
     * @var string
     * @ORM\Column(type="string", nullable=true) 
     */
    private $email;
    
    /**
     * @var string
     * @ORM\Column(type="string", nullable=true) 
     */
    private $firstName;
    
    /**
     * @var string
     * @ORM\Column(type="string", nullable=true) 
     */
    private $surname;
    
    /**
     * @var string
     * @ORM\Column(type="string", nullable=true) 
     */
    private $picture;
    
    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="SnippetDomain\Entity\Social", mappedBy="user", cascade={"all"}, orphanRemoval=true)
     */
    private $favorites;
    
    /**
     * @param string $userId
     */
    public function __construct($userId, $email = NULL)
    {
        $this->setUserId($userId);
        $this->setFavorites(new ArrayCollection());
        $this->setEmail($email);
    }
    
    /**
     * @return type
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param string $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
    
    public function getEmail()
    {
        return $this->email;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function getPicture()
    {
        return $this->picture;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    public function setPicture($picture)
    {
        $this->picture = $picture;
    }
    
    public function getFavorites()
    {
        return $this->favorites;
    }

    public function setFavorites(ArrayCollection $favorites)
    {
        $this->favorites = $favorites;
    }

}
