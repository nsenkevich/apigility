<?php
namespace Snippet\V1\Rest\User;

class UserResourceFactory
{
    public function __invoke($services)
    {
        return new UserResource($services->get('ZF\OAuth2\Adapter\PdoAdapter'), $services->get('userService'));
    }
}
