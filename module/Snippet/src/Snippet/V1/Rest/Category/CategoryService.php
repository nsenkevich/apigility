<?php

namespace Snippet\V1\Rest\Category;
use Doctrine\ORM\UnitOfWork;
use Snippet\V1\Rest\Category\CategoryRepository;

class CategoryService
{

    /**
     * @var \Doctrine\ORM\UnitOfWork
     */
    protected $unitOfWork;

    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @param UnitOfWork $unitOfWork
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(UnitOfWork $unitOfWork, CategoryRepository $categoryRepository)
    {
        $this->unitOfWork = $unitOfWork;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return array
     */
    public function findCategoriesList()
    {
        return $this->categoryRepository->getCategoriesList();
    }

    /**
     * @param int $id
     * @return array
     */
    public function findById($id)
    {
        return $this->categoryRepository->find($id);
    }
}
