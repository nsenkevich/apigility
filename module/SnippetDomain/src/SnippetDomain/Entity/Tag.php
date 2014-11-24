<?php

namespace SnippetDomain\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Snippet\V1\Rest\Tag\TagRepository")
 * @ORM\Table(name = "tags")
 */
class Tag
{

    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $tagId;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $text;

    /**
     * @var Snippet
     * @ORM\ManyToOne(targetEntity="SnippetDomain\Entity\Snippet", inversedBy="tags", cascade={"persist"})
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
     * @param string text
     */
    public function __construct($text)
    {
        $this->setText($text);
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
    
    public function getTagId()
    {
        return $this->tagId;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getSnippet()
    {
        return $this->snippet;
    }

    public function setTagId($tagId)
    {
        $this->tagId = $tagId;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function setSnippet($snippet)
    {
        $this->snippet = $snippet;
    }

}
