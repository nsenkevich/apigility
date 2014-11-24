<?php
namespace Snippet\V1\Rest\Category;

use Doctrine\ORM\EntityRepository;
use SnippetDomain\Entity\Category;

class CategoryRepository extends EntityRepository
{

    public function getCategoriesList()
    {   
        return Category::$categoriesList;
    }
}
