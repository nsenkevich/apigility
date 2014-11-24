<?php

namespace SnippetDomain;

use SnippetDomain\Repository\SnippetRepository;
use SnippetDomain\Entity\UserInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use SnippetDomain\Entity\Snippet;
use SnippetDomain\Entity\Tag;
use SnippetDomain\Entity\Category;
use SnippetDomain\Entity\User;
use OAuth2\Server;
use Doctrine\ORM\UnitOfWork;
use Doctrine\Common\Collections\Criteria;

class SnippetService
{

    /**
     * @var \Doctrine\ORM\UnitOfWork
     */
    protected $unitOfWork;
    
    /**
     * @var SnippetRepository
     */
    private $snippetRepository;

    /**
     * @param \SnippetDomain\UnitOfWork $unitOfWork
     * @param \SnippetDomain\Repository\SnippetRepository $snippetRepository
     */
    public function __construct(UnitOfWork $unitOfWork, SnippetRepository $snippetRepository)
    {
        $this->unitOfWork = $unitOfWork;
        $this->snippetRepository = $snippetRepository;
    }

    /**
     * @param stdClass $data
     */
    public function createSnippet($data, User $user)
    {
        $snippet = new Snippet($user, $data->title, $data->description, $data->code);
        foreach ($data->tags as $tag) {
            $snippet->addTag(new Tag($tag['text']));
        }

        foreach ($data->categories as $category) {
            $snippet->addCategory(new Category($category['category']));
        }

        return $snippet;

    }
    
    /**
     * @param Snippet $snippet
     */
    public function updateSnippet(Snippet $snippet, $data)
    {
        $snippet->getTags()->clear();
        $snippet->getCategories()->clear();
        
        $snippet->setTitle($data->title);
        $snippet->setDescription($data->description);
        $snippet->setCode($data->code);
        
        foreach ($data->tags as $tag) {
            $snippet->addTag(new Tag($tag['text']));
        }
        
        foreach ($data->categories as $category) {
            $snippet->addCategory(new Category($category['category']));
        }
        return $snippet;
    }
    
    /**
     * @param Snippet $snippet
     */
    public function saveSnippet(Snippet $snippet)
    {   
        $this->snippetRepository->saveEntity($snippet);
        return true;
    }

    /**
     * @param Snippet $snippet
     */
    public function removeSnippet(Snippet $snippet)
    {
        $this->unitOfWork->remove($snippet);
        $this->unitOfWork->commit($snippet);
        return true;
    }

    public function findAll()
    {
        return $this->snippetRepository->findAll();
    }
    
    /**
     * @param int $id
     * @return Entity\Snippet
     */
    public function findById($id)
    {
        return $this->snippetRepository->findOneById($id);
    }
    
    /**
     * @param string $slug
     * @return Entity\Snippet
     */
    public function findBySlug($slug)
    {
        return $this->snippetRepository->findOneBySlug($slug);
    }
    
    /**
     * @param int $userId
     * @return array
     */
    public function findCreatedByUser($userId)
    {
        return $this->snippetRepository->findByUserId($userId);
    }

    /**
     * @param string $category
     * @return array
     */
    public function findByCategory($category)
    {
        $qb = $this->snippetRepository->createQueryBuilder('s');
        $qb->select('s')
            ->innerJoin('s.categories', 'c')
            ->where($qb->expr()->eq('c.category', ':category'))
            ->setParameters(array('category' => $category));
        return $qb->getQuery()->getResult();
    }

    /**
     * @param string $tag
     * @return array
     */
    public function findByTag($tag)
    {
        $qb = $this->snippetRepository->createQueryBuilder('s');
        $qb->select('s')
            ->innerJoin('s.tags', 't')
            ->where($qb->expr()->eq('t.text', ':tag'))
            ->setParameters(array('tag' => $tag));
        return $qb->getQuery()->getResult();
    }

    /**
     * @param string $userId
     * @return array
     */
    public function findUserFavorites($userId)
    {
        $qb = $this->snippetRepository->createQueryBuilder('s');
        $qb->select('s')
            ->innerJoin('s.likes', 'f')
            ->innerJoin('f.user', 'u')
            ->where($qb->expr()->eq('u.userId', ':userId'))
            ->setParameters(array('userId' => $userId));
        return $qb->getQuery()->getResult();
    }
    
    public function findMostRecent()
    {
        return $this->snippetRepository->findMostRecent();
    }

    public function findMostCommented()
    {
        return $this->snippetRepository->findMostCommented();
    }

    public function findMostPopular()
    {
        return $this->snippetRepository->findMostPopular();
    }

}
