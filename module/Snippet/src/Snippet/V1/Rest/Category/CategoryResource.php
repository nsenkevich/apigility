<?php
namespace Snippet\V1\Rest\Category;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use Snippet\V1\Rest\Category\CategoryService;
use Zend\Paginator\Adapter\ArrayAdapter;
use Snippet\V1\Rest\Category\CategoryCollection;

class CategoryResource extends AbstractResourceListener
{
    /**
     *
     * @var CategoryService
     */
    private $categoryService;
    
    /**
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    
    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        return new ApiProblem(405, 'The POST method has not been defined');
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        $entity = $this->categoryService->findById($id);
        if($entity == null){
            return new ApiProblem(404, 'Categories for provided id not found');   
        }
        return $entity;
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = array())
    {
        $categories = array();
        $i = 0;
        foreach ($this->categoryService->findCategoriesList() as $key => $value) {
            $categories[$i]['category'] = $key;
            $categories[$i]['maker'] = $value;
            $i++;
        }
        
        return $categories;
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for individual resources');
    }
}
