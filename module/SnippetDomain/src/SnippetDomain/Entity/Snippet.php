<?php

namespace SnippetDomain\Entity;

use SnippetDomain\Entity\UserInterface;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use SnippetDomain\Entity\Tag;
use SnippetDomain\Entity\Category;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="SnippetDomain\Repository\SnippetRepository")
 * @ORM\Table(name = "snippets")
 */
class Snippet
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Gedmo\Slug(fields={"title"}, updatable=false, separator="-", unique=true)
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false) 
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $description;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $code;

    /**
     * @var UserInterface 
     */
    private $user;

    /**
     * @var string
     * @ORM\Column(type="string");
     */
    private $userId;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="SnippetDomain\Entity\Tag", mappedBy="snippet", cascade={"all"}, orphanRemoval=true)
     */
    private $tags;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="SnippetDomain\Entity\Category", mappedBy="snippet", cascade={"all"}, orphanRemoval=true)
     */
    private $categories;
    
    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="SnippetDomain\Entity\Social", mappedBy="snippet", cascade={"all"}, orphanRemoval=true)
     */
    private $likes;
            
    /**
     * @var DateTime
     * @ORM\Column(type = "datetime")
     */
    protected $dtc;

    /**
     * @var DateTime
     * @ORM\Column(type = "datetime")
     */
    protected $dtm;

    /**
     * @param UserInterface $user
     * @param string $title
     * @param string $description
     * @param string $code
     */
    public function __construct($user, $title, $description, $code)
    {                
        $this->setTitle($title);
        $this->setDescription($description);
        $this->setCode($code);
        $this->setUser($user);
        
        $this->tags = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->setLikes(new ArrayCollection());
        $this->dtc = new DateTime();
        $this->dtm = new DateTime();
    }

    /**
     * @ORM\PreUpdate()
     */
    public function preModified()
    {
        $this->dtm = new DateTime();
    }
    
    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $this->title.$this->id);
    }
    
    /**
     * @param Collection $tags
     */
    public function addTags(Collection $tags)
    {
        foreach ($tags as $tag) {
            $tag->setSnippet($this);
            $this->tags->add($tag);
        }
    }

    /**
     * @param Tag $tag
     */
    public function addTag(Tag $tag)
    {
        $tag->setSnippet($this);
        $this->tags->add($tag);
    }
    
    /**
     * @param Collection $tags
     */
    public function removeTags(Collection $tags)
    {
        foreach ($tags as $tag) {
            $tag->setSnippet(null);
            $this->tags->removeElement($tag);
        }
    }
    
    /**
     * @param Collection $categories
     */
    public function addCategories(Collection $categories)
    {
        foreach ($categories as $category) {
            $category->setSnippet($this);
            $this->categories->add($category);
        }  
    }
    
    /**
     * @param Category $category
     */
    public function addCategory(Category $category)
    {
        $category->setSnippet($this);
        $this->categories->add($category);
    }
    
    /**
     * @param Collection $categories
     */
    public function removeCategories(Collection $categories)
    {
        foreach ($categories as $category) {
            $category->setSnippet(null);
            $this->category->removeElement($categories);
        }
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        return $this->categories;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function setTitle($title)
    {
        $this->prePersist();
        $this->title = $title;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setCode($code)
    {
        $this->code = $code;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
        $this->userId = $user->getUserId();
    }

    public function getDtc()
    {
        return $this->dtc;
    }
    
    public function getLikes()
    {
        return $this->likes->count();
    }

    public function setLikes(ArrayCollection $likes)
    {
        $this->likes = $likes;
    }


    
}
