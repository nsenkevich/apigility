<?php
namespace Snippet\V1\Rest\Snippet;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use SnippetDomain\SnippetService;
use Zend\Paginator\Adapter\ArrayAdapter;
use OAuth2\Server;
use OAuth2\Request;
use SnippetDomain\Entity\User;
use Snippet\V1\Rest\User\UserService;

class SnippetResource extends AbstractResourceListener
{
    /**
     * @var SnippetService
     */
    private $snippetService;
 
    /**
     * @var UserService 
     */
    private $userService;
    
    /**
     * @param SnippetService $snippetService
     * @param UserService $userService
     */
    public function __construct(SnippetService $snippetService, UserService $userService)
    {
        $this->snippetService = $snippetService;
        $this->userService = $userService;
    }
    
    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {   
        $identity = $this->getIdentity()->getAuthenticationIdentity();
        
        if(!$identity){
            return new ApiProblem(401, 'Not authorised');   
        }
        
        $user = $this->userService->findById($identity['user_id']);
        if(!$user){
            return new ApiProblem(422, 'User with provided id not found');   
        }
        
        $snippet = $this->snippetService->createSnippet($data, $user);
        if(!$snippet){
            return new ApiProblem(422, 'Problem to create snippet');   
        }
        
        $result = $this->snippetService->saveSnippet($snippet);
        if(!$result){
            return new ApiProblem(422, 'Problem to save snippet');   
        }
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {  
        $identity = $this->getIdentity()->getAuthenticationIdentity();
        if(!$identity){
            return new ApiProblem(401, 'Not authorised');   
        }
        
        $snippet = $this->snippetService->findById($id);
        
        if($snippet->getUserId() != $identity['user_id']){
            return new ApiProblem(403, 'You Not authorised to remove current snippet');   
        }  
        
        if($snippet == null){
            return new ApiProblem(422, 'Invalid id passed');   
        }
        
        return $this->snippetService->removeSnippet($snippet);
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        $entity = $this->snippetService->findBySlug($id);

        if($entity == null){
            return new ApiProblem(422, 'Snippet with provided id not found');   
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
        $snippets = $this->snippetService->findAll();
        foreach ($params as $param => $value) {
            switch ($param) {
                case 'tag':
                    $snippets = $this->snippetService->findByTag($value);
                    break;
                case 'category':
                    return
                    $snippets = $this->snippetService->findByCategory($value);
                    break;
                case 'user':
                    $snippets = $this->snippetService->findCreatedByUser($value);
                    break;
                case 'favorites':
                    $snippets = $this->snippetService->findUserFavorites($value);
                    break;
                default:
                    $snippets = $this->snippetService->findAll();
                    break;
            }
        }

        return new SnippetCollection(new ArrayAdapter($snippets));
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
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
        $identity = $this->getIdentity()->getAuthenticationIdentity();
        if(!$identity){
            return new ApiProblem(401, 'Not authorised');   
        }
       
        $snippet = $this->snippetService->findBySlug($data->slug);
        
        if(!$snippet){
            return new ApiProblem(422, 'Problem to find snippet');   
        }
        
        if($snippet->getUserId() != $identity['user_id']){
            return new ApiProblem(403, 'You Not authorised to edit current snippet');   
        }        

        $snippet = $this->snippetService->updateSnippet($snippet, $data);
        if(!$snippet){
            return new ApiProblem(422, 'Problem to update snippet');   
        }
        
        $result = $this->snippetService->saveSnippet($snippet);
        if(!$result){
            return new ApiProblem(422, 'Problem to save snippet');   
        }
    }
}
