<?php
namespace Snippet\V1\Rest\Like;

use SnippetDomain\Entity\Social;
use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use SnippetDomain\SnippetService;
use Snippet\V1\Rest\User\UserService;

class LikeResource extends AbstractResourceListener
{
    
    /**
     * @var LikeService
     */
    private $likeService;
    
    /**
     * @var SnippetService 
     */
    private $snippetService;
    
    /**
     * @var UserService 
     */
    private $userService;
    
    /**
     * 
     * @param LikeService $likeService
     * @param SnippetService $snippetService
     * @param UserService $userService
     */
    public function __construct(LikeService $likeService, SnippetService $snippetService, UserService $userService)
    {
        $this->likeService = $likeService;
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
        
        $snippet = $this->snippetService->findById($data->nodeId);
        if(!$snippet){
            return new ApiProblem(422, 'Snippet with provided id not found');   
        }
        
        if($user->getUserId() === $snippet->getUserId()){
            return new ApiProblem(422, 'You can\'t like you own works');   
        }
        
        $likedNode = $this->likeService->findLikeByNodeAndUser($data->nodeId, $identity['user_id']);
        if($likedNode){
            return new ApiProblem(422, 'Already liked');  
        }

        $this->likeService->like(new Social($snippet, $user, Social::FAVORITE));
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
        $likedNode = $this->likeService->findLikeByNodeAndUser((int) $id, $identity['user_id']);
        
        if(!$likedNode){
            return new ApiProblem(422, 'Already unliked');
        }
        
        return $this->likeService->unlike($likedNode); 
        
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
        return new ApiProblem(405, 'The GET method has not been defined for individual resources');
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
