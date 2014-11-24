<?php

namespace SnippetDomain\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use SnippetDomain\Entity\Snippet;

/**
 * @ORM\Entity(repositoryClass="Snippet\V1\Rest\Category\CategoryRepository")
 * @ORM\Table(name = "categories")
 */
class Category
{

    const PHP     = 'php';
    const MYSQL   = 'mysql';
    const JQUERY  = 'jquery';
    
    public static $categoriesList = array (
        self::PHP       => 'PHP',
        self::MYSQL     => 'MySql',
        self::JQUERY    => 'jQuery',
    );
    
    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $categoryId;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $category;

    /**
     * @var Snippet
     * @ORM\ManyToOne(targetEntity="SnippetDomain\Entity\Snippet", inversedBy="categories", cascade={"persist"})
     */
    private $snippet;

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
     * @param string $category
     */
    public function __construct($category)
    {
        $this->setCategory($category);
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

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getSnippet()
    {
        return $this->snippet;
    }

    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function setSnippet($snippet)
    {
        $this->snippet = $snippet;
    }
    
}
