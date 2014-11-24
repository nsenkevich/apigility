<?php

namespace SnippetDomain\Entity;

use SnippetDomain\Entity\NodeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Snippet\V1\Rest\Like\LikeRepository")
 * @ORM\Table(name = "social")
 */
class Social
{
    const FAVORITE = 'favorite';
    
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $socialId;

    /**
     * @var int
     * @ORM\Column(type="integer");
     */
    private $nodeId;

    /**
     * @var string
     * @ORM\Column(type="string");
     */
    private $userId;

    /**
     * @var string
     * @ORM\Column(type="string");
     */
    private $type;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true);
     */
    private $description;

    /**
     * @var Snippet
     * @ORM\ManyToOne(targetEntity="SnippetDomain\Entity\Snippet", inversedBy="likes", cascade={"persist"})
     * @ORM\JoinColumn(name="nodeId", referencedColumnName="id")
     */
    private $snippet;
    
    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="SnippetDomain\Entity\User", inversedBy="favorites", cascade={"persist"})
     * @ORM\JoinColumn(name="userId", referencedColumnName="userId")
     */
    private $user;
    
    /**
     * @var array 
     */
    private $types = array(self::FAVORITE);
    
    /**
     * @param Snippet $snippet
     * @param User $user
     * @param string $type
     */
    public function __construct(Snippet $snippet, User $user, $type)
    {
        $this->setSnippet($snippet);
        $this->setUser($user);
        $this->setType($type);
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $type
     * @throws \InvalidArgumentException
     */
    public function setType($type)
    {
        if(!in_array($type, $this->types)) {
            throw new \InvalidArgumentException('Wrong type provided');
        }
        $this->type = $type;
    }

    /**
     * @param string $description
     * @throws \InvalidArgumentException
     */
    public function setDescription($description)
    {
        if(!is_string($description)){
            throw new \InvalidArgumentException();
        }
        $this->description = $description;
    }
    
    public function getSnippet()
    {
        return $this->snippet;
    }

    public function setSnippet(Snippet $snippet)
    {
        $this->snippet = $snippet;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }


}
