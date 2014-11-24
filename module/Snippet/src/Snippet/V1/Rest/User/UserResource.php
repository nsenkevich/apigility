<?php
namespace Snippet\V1\Rest\User;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use ZF\OAuth2\Adapter\PdoAdapter;
use ZF\ApiProblem\ApiProblemResponse;
use Snippet\V1\Rest\User\UserService;
use SnippetDomain\Entity\User;

class UserResource extends AbstractResourceListener
{
    /**
     * @var UserService 
     */
    private $userService;
    
    /**
     * @var PdoAdapte 
     */
    private $qAuth2Adapter;
    
    /**
     * @param PdoAdapter $qAuth2Adapter
     * @param UserService $userService
     */
    public function __construct(PdoAdapter $qAuth2Adapter, UserService $userService)
    {
        $this->qAuth2Adapter = $qAuth2Adapter;
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
        if($this->qAuth2Adapter->getUser($data->username)){
            return new ApiProblem(406, 'User with provided name already exist');
        }
        
        $this->userService->save(new User($data->username, $data->email));
        $this->qAuth2Adapter->setUser($data->username, $data->password);
        
        return new ApiProblem(200, 'Success');
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
        $identity = $this->getIdentity()->getAuthenticationIdentity();
        if(!$identity){
            return new ApiProblem(401, 'Not authorised');   
        }

        $entity = $this->userService->findById($identity['user_id']);

        if($entity == null){
            return new ApiProblem(404, 'User with provided id not found');   
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
        return new ApiProblem(405, 'The GET method has not been defined for collections');
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
