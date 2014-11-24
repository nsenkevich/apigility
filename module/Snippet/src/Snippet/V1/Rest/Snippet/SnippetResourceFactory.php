<?php
namespace Snippet\V1\Rest\Snippet;

class SnippetResourceFactory
{
    public function __invoke($services)
    {
        return new SnippetResource($services->get('snippetService'), $services->get('userService'));
    }
}
