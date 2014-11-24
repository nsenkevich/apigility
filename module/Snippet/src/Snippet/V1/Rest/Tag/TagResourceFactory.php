<?php
namespace Snippet\V1\Rest\Tag;
use Snippet\V1\Rest\Tag\TagResource;

class TagResourceFactory
{
    public function __invoke($services)
    {
        return new TagResource($services->get('tagService'));
    }
}
