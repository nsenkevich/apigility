<?php
namespace Snippet\V1\Rest\Tag;

use Doctrine\ORM\UnitOfWork;
use Snippet\V1\Rest\Tag\TagRepository;

class TagService
{

    /**
     * @var \Doctrine\ORM\UnitOfWork
     */
    protected $unitOfWork;

    /**
     * @var TagRepository
     */
    protected $tagRepository;

    /**
     * @param UnitOfWork $unitOfWork
     * @param TagRepository $tagRepository
     */
    public function __construct(UnitOfWork $unitOfWork, TagRepository $tagRepository)
    {
        $this->unitOfWork = $unitOfWork;
        $this->tagRepository = $tagRepository;
    }

    /**
     * @return array
     */
    public function findTagsList()
    {
        return $this->tagRepository->findTagsList();
    }
}
