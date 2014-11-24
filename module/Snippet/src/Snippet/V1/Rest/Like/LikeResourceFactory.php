<?php
namespace Snippet\V1\Rest\Like;

class LikeResourceFactory
{
    public function __invoke($services)
    {
        return new LikeResource($services->get('likeService'), $services->get('snippetService'), $services->get('userService'));
    }
}
